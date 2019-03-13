<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgRealEstate module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wgrealestate
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         Wedega - Email:<webmaster@wedega.com> - Website:<https://wedega.com>
 * @version        $Id: 1.0 objects.php 1 Sun 2018-01-07 21:18:22Z XOOPS Project (www.xoops.org) $
 */
include __DIR__ . '/header.php';
$GLOBALS['xoopsOption']['template_main'] = 'wgrealestate_contact.tpl';
include_once XOOPS_ROOT_PATH .'/header.php';

$op    = XoopsRequest::getString('op', 'none');
$objId = XoopsRequest::getInt('obj_id', 0);

// Define Stylesheet
$GLOBALS['xoTheme']->addStylesheet( $style, null );
// 
$GLOBALS['xoopsTpl']->assign('wgrealestate_icons32_url', WGREALESTATE_ICONS_URL . '/32/');
$GLOBALS['xoopsTpl']->assign('wgrealestate_url', WGREALESTATE_URL);
$GLOBALS['xoopsTpl']->assign('wgrealestate_obj_image_url', WGREALESTATE_UPLOAD_IMAGE_URL.'/objects/');

// assign rights of current user
$GLOBALS['xoopsTpl']->assign('isModerator', $isModerator);

$objectsObj = $objectsHandler->get($objId);

switch ($op) {
    case 'none':
	default:
		// check for recaptcha
		if (0 < $wgrealestate->getConfig('recaptchause')) {
			$GLOBALS['xoopsTpl']->assign('recaptcha', true);
			$recaptchakey = $wgrealestate->getConfig('recaptchakey');
		}
		$form = $objectsObj->getFormObjectContact($recaptchakey);
		$GLOBALS['xoopsTpl']->assign('form', $form->render());
		
		$GLOBALS['xoopsTpl']->assign('obj_id', $objectsObj->getVar('obj_id'));
		$GLOBALS['xoopsTpl']->assign('subject', $objectsObj->getVar('obj_title'));
		$GLOBALS['xoopsTpl']->assign('contact_info', $wgrealestate->getConfig('contact_info'));
		$GLOBALS['xoopsTpl']->assign('contact_default', $wgrealestate->getConfig('contact_default'));
	break;
	
	case 'send_request':
		// check recaptcha
		$captcha = '';
		if ('' !== XoopsRequest::getString('g-recaptcha-response', '', 'POST')) {
			$captcha = XoopsRequest::getString('g-recaptcha-response', '', 'POST');
		}
		if (!$captcha && $wgrealestate->getConfig('recaptchause')) {
			redirect_header('index.php', 2, _MD_CONTACT_MES_NOCAPTCHA);
		} else {
			$response=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $xoopsModuleConfig['recaptchakey'] . '&response=' . $captcha . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
			if ($response.success === false && $wgrealestate->getConfig('recaptchause')) {
				redirect_header('index.php', 2, _MD_CONTACT_MES_CAPTCHAINCORRECT);
			}
		}
		// recaptcha ok, send mails
		if ( $wgrealestate->getConfig('contact_recipient_std') ) {
			require_once XOOPS_ROOT_PATH . '/class/xoopsmailer.php';
			global $xoopsModule, $xoopsConfig;
			
			$GLOBALS['xoopsTpl']->assign('obj_id', $objectsObj->getVar('obj_id'));
			
			$sendername = $xoopsConfig['sitename'];
			$obj_title  = $objectsObj->getVar('obj_title');
			$subject    = $obj_title;
			$name       = XoopsRequest::getString('contact_name', '-');
			$phone      = XoopsRequest::getString('contact_phone', '-');
			$mail       = XoopsRequest::getString('contact_mail', '-');
			$message    = XoopsRequest::getString('contact_message', '-');
			$confirm    = XoopsRequest::getInt('contact_confirm', 0);
			$link       = WGREALESTATE_URL . '/objects.php?op=show&amp;obj_id=' . $objId;
			$template   = 'notify_contact.tpl';

			$recipients = explode('|', $wgrealestate->getConfig('contact_recipient_std'));
			foreach ($recipients as $recipient) {
				$sender = $recipient;

				$xoopsMailer = xoops_getMailer();
				$xoopsMailer->useMail();
				//set template path
				if (file_exists(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/language/' . $xoopsConfig['language'] . '/')) {
					$xoopsMailer->setTemplateDir(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/language/' . $xoopsConfig['language'] . '/mail_template/');
				} else {
					$xoopsMailer->setTemplateDir(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/language/english/mail_template/');
				}
				//set template name
				$xoopsMailer->setTemplate($template);
				//set sender
				$xoopsMailer->setFromEmail($sender);
				//set name of sender
				$xoopsMailer->setFromName($sendername);
				//set subject
				$xoopsMailer->setSubject($subject);
				//assign vars in template
				$xoopsMailer->assign('OBJ_LINK', $link);
				$xoopsMailer->assign('OBJ_TITLE', $obj_title);
				$xoopsMailer->assign('NAME', $name);
				$xoopsMailer->assign('PHONE', $phone);
				$xoopsMailer->assign('MAIL', $mail);
				$xoopsMailer->assign('MESSAGE', $message);
				//set recipient
				$xoopsMailer->setToEmails($recipient);

				//execute sending
				$xoopsMailer->send();
				$error = $xoopsMailer->getErrors();
				if ($error) {
					$GLOBALS['xoopsTpl']->assign('error', $error);
					$GLOBALS['xoopsTpl']->assign('error_info', _MA_WGREALESTATE_CONTACT_SUBMIT_FAILED);
				}
				$xoopsMailer->reset();
			}
			// update counter requests
			$objectsObj->setVar('obj_contacts', $objectsObj->getVar('obj_contacts') + 1);
			$objectsHandler->insert($objectsObj, true);
			
			// send confirm mail if selected
			if ( 0 < $confirm ) {
				if ('-' != $mail) {
					$template   = 'notify_contact_confirm.tpl';
			
					$sender = $wgrealestate->getConfig('contact_reply');
					$xoopsMailer = xoops_getMailer();
					$xoopsMailer->useMail();
					//set template path
					if (file_exists(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/language/' . $xoopsConfig['language'] . '/')) {
						$xoopsMailer->setTemplateDir(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/language/' . $xoopsConfig['language'] . '/mail_template/');
					} else {
						$xoopsMailer->setTemplateDir(XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/language/english/mail_template/');
					}
					//set template name
					$xoopsMailer->setTemplate($template);
					//set sender
					$xoopsMailer->setFromEmail($sender);
					//set name of sender
					$xoopsMailer->setFromName($sendername);
					//set subject
					$xoopsMailer->setSubject($subject);
					//assign vars in template
					$xoopsMailer->assign('OBJ_LINK', $link);
					$xoopsMailer->assign('OBJ_TITLE', $obj_title);
					$xoopsMailer->assign('NAME', $name);
					$xoopsMailer->assign('PHONE', $phone);
					$xoopsMailer->assign('MAIL', $mail);
					$xoopsMailer->assign('MESSAGE', $message);
					//set recipient
					$xoopsMailer->setToEmails($mail);

					//execute sending
					$xoopsMailer->send();
					$error = $xoopsMailer->getErrors();
					if ($error) {
						$GLOBALS['xoopsTpl']->assign('error', $error);
						$GLOBALS['xoopsTpl']->assign('error_info', _MA_WGREALESTATE_CONTACT_SUBMIT_FAILED);
					}
					$xoopsMailer->reset();
				}
			}
			if (!$error) {
				redirect_header('objects.php?op=show&amp;obj_id=' . $objId, 3, _MA_WGREALESTATE_CONTACT_SUBMIT_SUCCESS);
			}
		}
	break;
}

// Breadcrumbs
$xoBreadcrumbs[] = array('title' => _CO_WGREALESTATE_OBJECTS);

// Description
wgrealestateMetaDescription(_MA_WGREALESTATE_CONTACT);

include __DIR__ . '/footer.php';
