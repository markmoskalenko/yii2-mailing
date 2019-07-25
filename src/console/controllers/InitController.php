<?php

namespace markmoskalenko\mailing\console\controllers;

use markmoskalenko\mailing\common\models\emailSendLog\EmailSendLog;
use markmoskalenko\mailing\common\models\template\Template;
use markmoskalenko\mailing\common\models\templateEmail\TemplateEmail;
use yii\console\Controller;

/**
 * Инициализация тарифных планов
 */
class InitController extends Controller
{
    public function actionClear()
    {
        EmailSendLog::deleteAll();
        Template::deleteAll();
        TemplateEmail::deleteAll();
    }

    public function actionIndex()
    {
        $template = new Template();
        $template->name = 'Первое письмо после регистрации';
        $template->key = 'helloMail';
        $template->priority = 1;
        $template->save();

        $email = new TemplateEmail();
        $email->subject = 'Добро пожаловать в MyBase.pro!';
        $email->lang = 'ru';
        $email->templateId = $template->_id;
        $email->affiliateDomain = 'mybase.pro';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    <!--[if gte mso 9]>
    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
        <v:fill type="tile" color="#ffffff"></v:fill>
    </v:background>
    <![endif]-->
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%"
           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;"
                                   bgcolor="rgba(0, 0, 0, 0)">
                                <tr style="border-collapse:collapse;">
                                    <td align="left"
                                        style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;"
                                        bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center"
                                                                style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/6731554506565421.png"
                                                                     alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды"
                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
                                                                     class="adapt-img" width="530"
                                                                     title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды">
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l"
                                                                style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;">
                                                                <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#3BC7AB;">
                                                                    <strong>Добро пожаловать в MyBase!</strong></h1>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l"
                                                                style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;">
                                                                <ol>
                                                                    <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;Margin-bottom:15px;color:#666666;">
                                                                        {firstName}, для начала, создайте базу знаний и
                                                                        добавьте в неё несколько статей, ссылок или
                                                                        видео. Чтобы понять общие принципы наполнения
                                                                        базы контентом и структурированием его в
                                                                        сервисе.
                                                                    </li>
                                                                    <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;Margin-bottom:15px;color:#666666;">
                                                                        Если вы планируете использовать базу знаний не
                                                                        только лично, пригласите коллег (для этого
                                                                        просто отправьте им ссылку скопировав ее в
                                                                        разделе «команда»
                                                                    </li>
                                                                    <li style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;Margin-bottom:15px;color:#666666;">
                                                                        Любые вопросы по использованию сервиса или ваши
                                                                        предложения обязательно пишите нам на почту
                                                                        hello@mybase.pro или&nbsp;в онлайн-чате
                                                                        поддержки в базе знаний, будем рады ответить!
                                                                    </li>
                                                                </ol>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    С уважением, Команда MyBase.pro</p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l"
                                                                style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                                                <span class="es-button-border"
                                                                      style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a
                                                                        href="{confirmMailLink}" class="es-button" target="_blank"
                                                                        style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Подтвердить эл.почту</a> </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tr style="border-collapse:collapse;">
                                    <td align="left"
                                        style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;padding-bottom:10px;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                       class="es-table-not-adapt es-social"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank"
                                                                               href="https://www.facebook.com/smartportalpro/"
                                                                               style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                                <img src="/images/facebook-logo-gray.png"
                                                                                     alt="Fb" title="Facebook"
                                                                                     width="32"
                                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                            </a></td>
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank"
                                                                               href="https://vk.com/smartportalpro"
                                                                               style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                                <img src="/images/vk-logo-gray.png"
                                                                                     alt="VK" title="Vkontakte"
                                                                                     width="32"
                                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                            </a></td>
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank"
                                                                               href="https://www.instagram.com/smartportalpro/"
                                                                               style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                                <img src="/images/instagram-logo-gray.png"
                                                                                     alt="Ig" title="Instagram"
                                                                                     width="32"
                                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                            </a></td>
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;"><a
                                                                                target="_blank"
                                                                                href="https://t.me/smartportal"
                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                            <img src="/images/telegram-logo-gray.png"
                                                                                 alt="Telegram" title="Telegram"
                                                                                 width="32"
                                                                                 style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                        </a></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    MyBase © {currentYear}  All rights reserved</p></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
';

        $email->save();

        $template = new Template();
        $template->name = 'Оплата совершена успешно';
        $template->key = 'subscribeSuccess';
        $template->priority = 1;
        $template->save();

        $email = new TemplateEmail();
        $email->subject = 'Оплата совершена успешно';
        $email->lang = 'ru';
        $email->templateId = $template->_id;
        $email->affiliateDomain = 'mybase.pro';
        $email->body = '
<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody>
        <tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody>
                    <tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody>
                                <tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody>
                                            <tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody>
                                            <tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody>
                                                        <tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/6731554506565421.png" alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="bcu3lsk3aots"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;">
                                                                <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#3BC7AB;">
                                                                    <strong>Подписка продлена!</strong></h1></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Поздравляем! Теперь у вас премиум подписка</p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Ваш тариф: <strong>«{tariffName}»
                                                                    {description}</strong></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Подписка действует
                                                                    до:&nbsp;<strong>{expiredAt}</strong></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Расскажите знакомым в соц.сетях&nbsp;о mybase.pro, вы
                                                                    поможете&nbsp;сервису в развитии, и новые&nbsp;обновления
                                                                    будут выходить&nbsp;быстрее</p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                                                <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{webAppLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Перейти в сервис</a> </span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody>
                    <tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody>
                                <tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody>
                                            <tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-bottom:10px;">
                                                                <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tbody>
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.facebook.com/smartportalpro/">
                                                                                <img src="/images/facebook-logo-gray.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="o0ptx5j3cxdu"> </a>
                                                                        </td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://vk.com/smartportalpro">
                                                                                <img src="/images/vk-logo-gray.png" alt="VK" title="Vkontakte" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="i3f909hfzkbd"> </a>
                                                                        </td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.instagram.com/smartportalpro/">
                                                                                <img src="/images/instagram-logo-gray.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="uzxccc6s0jyb"> </a>
                                                                        </td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;"><a target="_blank" href="https://t.me/smartportal"> <img src="/images/telegram-logo-gray.png" alt="Telegram" title="Telegram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="ll1i3gy74yzp"> </a></td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    MyBase.pro © {currentYear} All rights reserved</p></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>';
        $email->save();


        $template = new Template();
        $template->name = 'Пробный период скоро закончится';
        $template->key = 'trialPeriodWillEndSoon';
        $template->priority = 1;
        $template->save();

        $email = new TemplateEmail();
        $email->subject = 'Пробный период скоро закончится';
        $email->lang = 'ru';
        $email->templateId = $template->_id;
        $email->affiliateDomain = 'mybase.pro';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    <!--[if gte mso 9]>
    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
        <v:fill type="tile" color="#ffffff"></v:fill>
    </v:background>
    <![endif]-->
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%"
           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;"
                                   bgcolor="rgba(0, 0, 0, 0)">
                                <tr style="border-collapse:collapse;">
                                    <td align="left"
                                        style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;"
                                        bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center"
                                                                style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/6731554506565421.png"
                                                                     alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды"
                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
                                                                     class="adapt-img" width="530"
                                                                     title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды">
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l"
                                                                style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;">
                                                                <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;">
                                                                    <strong>Пробный период заканчивается через 2 дня</strong></h1></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l"
                                                                style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Здравствуйте, {firstName}! Через 2 дня у вас заканчивается
                                                                    пробный период в MyBase. Доступ к вашим материалам
                                                                    будет закрыт. Вы можете оплатить тариф сейчас, а
                                                                    подписка начнется по окончанию пробного периода.</p>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l"
                                                                style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                                                <span class="es-button-border"
                                                                      style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a
                                                                        href="{paymentLink}" class="es-button" target="_blank"
                                                                        style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Перейти к оплате</a> </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tr style="border-collapse:collapse;">
                                    <td align="left"
                                        style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;padding-bottom:10px;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                       class="es-table-not-adapt es-social"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank"
                                                                               href="https://www.facebook.com/smartportalpro/"
                                                                               style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                                <img src="/images/facebook-logo-gray.png"
                                                                                     alt="Fb" title="Facebook"
                                                                                     width="32"
                                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                            </a></td>
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank"
                                                                               href="https://vk.com/smartportalpro"
                                                                               style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                                <img src="/images/vk-logo-gray.png"
                                                                                     alt="VK" title="Vkontakte"
                                                                                     width="32"
                                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                            </a></td>
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank"
                                                                               href="https://www.instagram.com/smartportalpro/"
                                                                               style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                                <img src="/images/instagram-logo-gray.png"
                                                                                     alt="Ig" title="Instagram"
                                                                                     width="32"
                                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                            </a></td>
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;"><a
                                                                                target="_blank"
                                                                                href="https://t.me/smartportal"
                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                            <img src="/images/telegram-logo-gray.png"
                                                                                 alt="Telegram" title="Telegram"
                                                                                 width="32"
                                                                                 style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                        </a></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    MyBase © {currentYear} All rights reserved</p></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
';
        $email->save();


        $template = new Template();
        $template->name = 'Вам открыли доступ в базу знаний';
        $template->key = 'invite';
        $template->priority = 1;
        $template->save();

        $email = new TemplateEmail();
        $email->subject = 'Вам открыли доступ в базу знаний';
        $email->lang = 'ru';
        $email->templateId = $template->_id;
        $email->affiliateDomain = 'mybase.pro';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;"> <img src="/images/6731554506565421.png" alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="wo1mhhsogus4"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;"> <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#3BC7AB;"><strong>Вам открыли доступ в базу знаний</strong></h1> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>{senderName}&nbsp;</strong>открыл вам доступ в базу знаний&nbsp;<strong>{baseName}.</strong></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Нажмите&nbsp;кнопку ниже, чтобы настроить учетную запись и начать совместную&nbsp;работу:</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;"> <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{confirmationInviteLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Перейти в сервис</a> </span> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-bottom:10px;">
                                                                <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tbody><tr style="border-collapse:collapse;">
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;"> <a target="_blank" href="https://www.facebook.com/smartportalpro/"> <img src="/images/facebook-logo-gray.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="4pymqdr45tct"> </a> </td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;"> <a target="_blank" href="https://vk.com/smartportalpro"> <img src="/images/vk-logo-gray.png" alt="VK" title="Vkontakte" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="rsjixxl59a7l"> </a> </td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;"> <a target="_blank" href="https://www.instagram.com/smartportalpro/"> <img src="/images/instagram-logo-gray.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="uqoi30jsjkwl"> </a> </td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;"> <a target="_blank" href="https://t.me/smartportal"> <img src="/images/telegram-logo-gray.png" alt="Telegram" title="Telegram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="4wkaofq8bz2s"> </a> </td>
                                                                    </tr>
                                                                </tbody></table> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">MyBase © {currentYear} All rights reserved</p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table> </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();


        $template = new Template();
        $template->name = 'Пробный период закончился';
        $template->key = 'trialPeriodIsOver';
        $template->priority = 1;
        $template->save();

        $email = new TemplateEmail();
        $email->subject = 'Пробный период закончился';
        $email->lang = 'ru';
        $email->templateId = $template->_id;
        $email->affiliateDomain = 'mybase.pro';
        $email->body = '
<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/6731554506565421.png" alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="bpcx4ikhbf6j">
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;">
                                                                <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;">
                                                                    <strong>Пробный период закончился</strong></h1></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">{firstName}, спасибо, что попробовали MyBase. Пожалуйста,
                                                                    оплатите подписку, чтобы продолжить пользование.</p>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                                                <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Перейти к оплате</a> </span>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-bottom:10px;">
                                                                <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tbody><tr style="border-collapse:collapse;">
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.facebook.com/smartportalpro/">
                                                                                <img src="/images/facebook-logo-gray.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="xtqmh1chq5xs">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://vk.com/smartportalpro">
                                                                                <img src="/images/vk-logo-gray.png" alt="VK" title="Vkontakte" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="e8gpnv3wd198">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.instagram.com/smartportalpro/">
                                                                                <img src="/images/instagram-logo-gray.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="ukngoabng2di">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;"><a target="_blank" href="https://t.me/smartportal">
                                                                            <img src="/images/telegram-logo-gray.png" alt="Telegram" title="Telegram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="jy0mv88jakc0">
                                                                        </a></td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    MyBase © {currentYear} All rights reserved</p></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();

        $template = new Template();
        $template->name = 'Премиум период закончился';
        $template->key = 'proPeriodIsOver';
        $template->priority = 1;
        $template->save();

        $email = new TemplateEmail();
        $email->subject = 'Премиум период закончился';
        $email->lang = 'ru';
        $email->templateId = $template->_id;
        $email->affiliateDomain = 'mybase.pro';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/6731554506565421.png" alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="bpcx4ikhbf6j">
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;">
                                                                <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;"><strong>Премиум период закончился</strong></h1></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">{firstName}, спасибо, что используете MyBase. Пожалуйста,
                                                                    оплатите подписку, чтобы продолжить пользование.</p>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                                                <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Перейти к оплате</a> </span>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-bottom:10px;">
                                                                <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tbody><tr style="border-collapse:collapse;">
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.facebook.com/smartportalpro/">
                                                                                <img src="/images/facebook-logo-gray.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="xtqmh1chq5xs">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://vk.com/smartportalpro">
                                                                                <img src="/images/vk-logo-gray.png" alt="VK" title="Vkontakte" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="e8gpnv3wd198">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.instagram.com/smartportalpro/">
                                                                                <img src="/images/instagram-logo-gray.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="ukngoabng2di">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;"><a target="_blank" href="https://t.me/smartportal">
                                                                            <img src="/images/telegram-logo-gray.png" alt="Telegram" title="Telegram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="jy0mv88jakc0">
                                                                        </a></td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    MyBase © {currentYear} All rights reserved</p></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();

        $template = new Template();
        $template->name = 'Пробный период закончится уже завтра';
        $template->key = 'tomorrowTheTestPeriodWillEnd';
        $template->priority = 1;
        $template->save();

        $email = new TemplateEmail();
        $email->subject = 'Пробный период закончится уже завтра';
        $email->lang = 'ru';
        $email->templateId = $template->_id;
        $email->affiliateDomain = 'mybase.pro';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    <!--[if gte mso 9]>
    <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
        <v:fill type="tile" color="#ffffff"></v:fill>
    </v:background>
    <![endif]-->
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%"
           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;"
                                   bgcolor="rgba(0, 0, 0, 0)">
                                <tr style="border-collapse:collapse;">
                                    <td align="left"
                                        style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;"
                                        bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center"
                                                                style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/6731554506565421.png"
                                                                     alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды"
                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;"
                                                                     class="adapt-img" width="530"
                                                                     title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды">
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l"
                                                                style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;">
                                                                <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;">
                                                                    <strong>Пробный период заканчивается уже завтра</strong></h1></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l"
                                                                style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Здравствуйте, {firstName}! Завтра у вас заканчивается
                                                                    пробный период в MyBase. Доступ к вашим материалам
                                                                    будет закрыт. Вы можете оплатить тариф сейчас, а
                                                                    подписка начнется по окончанию пробного периода.</p>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l"
                                                                style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                                                <span class="es-button-border"
                                                                      style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a
                                                                        href="{paymentLink}" class="es-button" target="_blank"
                                                                        style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Перейти к оплате</a> </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center"
                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600"
                                   style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tr style="border-collapse:collapse;">
                                    <td align="left"
                                        style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%"
                                               style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%"
                                                           style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;padding-bottom:10px;">
                                                                <table cellpadding="0" cellspacing="0"
                                                                       class="es-table-not-adapt es-social"
                                                                       style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tr style="border-collapse:collapse;">
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank"
                                                                               href="https://www.facebook.com/smartportalpro/"
                                                                               style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                                <img src="/images/facebook-logo-gray.png"
                                                                                     alt="Fb" title="Facebook"
                                                                                     width="32"
                                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                            </a></td>
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank"
                                                                               href="https://vk.com/smartportalpro"
                                                                               style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                                <img src="/images/vk-logo-gray.png"
                                                                                     alt="VK" title="Vkontakte"
                                                                                     width="32"
                                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                            </a></td>
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank"
                                                                               href="https://www.instagram.com/smartportalpro/"
                                                                               style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                                <img src="/images/instagram-logo-gray.png"
                                                                                     alt="Ig" title="Instagram"
                                                                                     width="32"
                                                                                     style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                            </a></td>
                                                                        <td align="center" valign="top"
                                                                            style="padding:0;Margin:0;"><a
                                                                                target="_blank"
                                                                                href="https://t.me/smartportal"
                                                                                style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:11px;text-decoration:underline;color:#1376C8;">
                                                                            <img src="/images/telegram-logo-gray.png"
                                                                                 alt="Telegram" title="Telegram"
                                                                                 width="32"
                                                                                 style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;">
                                                                        </a></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center"
                                                                style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    MyBase © {currentYear} All rights reserved</p></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
';
        $email->save();

        $template = new Template();
        $template->name = 'Тарифный план закончится уже завтра';
        $template->key = 'tomorrowTheProPeriodWillEnd';
        $template->priority = 1;
        $template->save();

        $email = new TemplateEmail();
        $email->subject = 'Тарифный план закончится уже завтра';
        $email->lang = 'ru';
        $email->templateId = $template->_id;
        $email->affiliateDomain = 'mybase.pro';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/6731554506565421.png" alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="en9abkqb076m">
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" bgcolor="#ffffff" style="Margin:0;padding-top:20px;padding-bottom:40px;padding-left:40px;padding-right:40px;background-color:#FFFFFF;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-bottom:15px;"><h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;">
                                                                <strong>Тарифный план заканчивается уже завтра</strong></h1></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                Здравствуйте, {firstName}! Завтра у вас заканчивается
                                                                оплаченный период в MyBase. Доступ к вашим материалам будет
                                                                закрыт.</p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-left:10px;padding-right:10px;padding-bottom:30px;padding-top:35px;">
                                                                <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Перейти к оплате</a> </span>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-bottom:10px;">
                                                                <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tbody><tr style="border-collapse:collapse;">
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.facebook.com/smartportalpro/">
                                                                                <img src="/images/facebook-logo-gray.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="yc3xeu3aioa5">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://vk.com/smartportalpro">
                                                                                <img src="/images/vk-logo-gray.png" alt="VK" title="Vkontakte" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="q5846mreg209">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.instagram.com/smartportalpro/">
                                                                                <img src="/images/instagram-logo-gray.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="lsonie1yd34a">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;"><a target="_blank" href="https://t.me/smartportal">
                                                                            <img src="/images/telegram-logo-gray.png" alt="Telegram" title="Telegram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="52jtclxa453e">
                                                                        </a></td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    My<strong>Base</strong></p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    MyBase © {currentYear} All rights reserved</p></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();

        $template = new Template();
        $template->name = 'Платный период скоро закончится';
        $template->key = 'proPeriodWillEndSoon';
        $template->priority = 1;
        $template->save();

        $email = new TemplateEmail();
        $email->subject = 'Платный период скоро закончится';
        $email->lang = 'ru';
        $email->templateId = $template->_id;
        $email->affiliateDomain = 'mybase.pro';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/6731554506565421.png" alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="en9abkqb076m">
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table bgcolor="#ffffff" class="es-content-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" bgcolor="#ffffff" style="Margin:0;padding-top:20px;padding-bottom:40px;padding-left:40px;padding-right:40px;background-color:#FFFFFF;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-bottom:15px;"><h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;"><strong>Платный период заканчивается через 2
                                                                    дня</strong></h1></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                Здравствуйте, {firstName}! Через 2 дня&nbsp;у вас заканчивается
                                                                платный период в MyBase. Доступ к вашим материалам будет
                                                                закрыт.</p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-left:10px;padding-right:10px;padding-bottom:30px;padding-top:35px;">
                                                                <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Перейти к оплате</a> </span>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-bottom:10px;">
                                                                <table cellpadding="0" cellspacing="0" class="es-table-not-adapt es-social" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                                    <tbody><tr style="border-collapse:collapse;">
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.facebook.com/smartportalpro/">
                                                                                <img src="/images/facebook-logo-gray.png" alt="Fb" title="Facebook" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="yc3xeu3aioa5">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://vk.com/smartportalpro">
                                                                                <img src="/images/vk-logo-gray.png" alt="VK" title="Vkontakte" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="q5846mreg209">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;padding-right:10px;">
                                                                            <a target="_blank" href="https://www.instagram.com/smartportalpro/">
                                                                                <img src="/images/instagram-logo-gray.png" alt="Ig" title="Instagram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="lsonie1yd34a">
                                                                            </a></td>
                                                                        <td align="center" valign="top" style="padding:0;Margin:0;"><a target="_blank" href="https://t.me/smartportal">
                                                                            <img src="/images/telegram-logo-gray.png" alt="Telegram" title="Telegram" width="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" data-image="52jtclxa453e">
                                                                        </a></td>
                                                                    </tr>
                                                                </tbody></table>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    My<strong>Base</strong></p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    MyBase © {currentYear} All rights reserved</p></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();
    }

    public function actionBurobase()
    {
        $id = Template::findOne(['key'=>'helloMail'])->_id;

        $email = new TemplateEmail();
        $email->subject = 'Добро пожаловать в burobase.ru!';
        $email->lang = 'ru';
        $email->templateId = $id;
        $email->affiliateDomain = 'burobase.ru';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;"> <img src="/images/9691557085610161.png" alt="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="MyBase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="xk78shzeufqh"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;"> <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#3BC7AB;"><strong>Добро пожаловать в BuroBase</strong></h1> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Добро пожаловать, <strong>{firstName}</strong>! Спасибо за регистрацию в BuroBase. Мы рады видеть Вас!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Чтобы получить доступ к полному функционалу, подтвердите свой адрес электронной почты:</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;"> <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{confirmMailLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Подтвердить эл.почту</a> </span> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Ниже Ваши доступы для входа в BuroBase:</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Страница входа: <strong>{singInLink}</strong></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Имя пользователя:<strong> {email}</strong></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Вы получили доступ к семидневной пробной версии.&nbsp;В течение семи дней Вам будут доступны все функции тарифа <strong>«Корпорация»</strong>. (ссылка на страницу с тарифами). Вы можете продлить пользование данным тарифом, оплатив счет.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Дата регистрации: <strong>{signUpAt}</strong></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Пробный период до:&nbsp;<strong>{expiredAt}</strong></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Если у вас есть какие-либо вопросы, не стесняйтесь, напишите нашей команде поддержки. Мы всегда на связи!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">С уважением, команда BuroBase.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">P.S. нужна немедленная помощь, чтобы начать? Ознакомьтесь с нашей справочной документацией . Или просто ответьте на это письмо, команда поддержки BuroBase всегда готова помочь!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">Для связи с нами: +7 495 221 89 91</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">BuroBase © {currentYear} All rights reserved</p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>                             
                            </tbody></table> </td>
                    </tr>
                </tbody></table> </td>
        </tr>
    </tbody></table>
</div>';

        $email->save();

        $id = Template::findOne(['key'=>'subscribeSuccess'])->_id;


        $email = new TemplateEmail();
        $email->subject = 'Оплата совершена успешно';
        $email->lang = 'ru';
        $email->templateId = $id;
        $email->affiliateDomain = 'burobase.ru';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/9691557085610161.png" alt="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="s41hcmimko34">
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;">
                                                                <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#3BC7AB;">
                                                                    <strong>Оплата совершена успешно!</strong></h1></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Добрый день, <strong>{firstName}</strong>!</p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Спасибо за использование BuroBase. Это письмо
                                                                    является электронным чеком, подтверждающим
                                                                    оплату.</p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Подписка продлена&nbsp;до: <strong>{expiredAt}</strong>
                                                                </p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Тариф: <strong>{tariffName}</strong></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Сумма оплаты: <strong>{sum}</strong></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Если у вас есть какие-либо вопросы по поводу этого
                                                                    чека, просто ответьте на это письмо или обратитесь в
                                                                    нашу службу поддержки за помощью.</p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    С уважением, команда BuroBase.</p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                                                <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{webAppLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Перейти в сервис</a> </span>
                                                            </td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    Для связи с нами: +7 495 221 89 91</p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    BuroBase © {currentYear} All rights reserved</p></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();


        $id = Template::findOne(['key'=>'trialPeriodWillEndSoon'])->_id;

        $email = new TemplateEmail();
        $email->subject = 'Пробный период скоро закончится';
        $email->lang = 'ru';
        $email->templateId = $id;
        $email->affiliateDomain = 'burobase.ru';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;"> <img src="/images/9691557085610161.png" alt="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="8ch5q2ganicr"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;"> <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;"><strong>Пробный период заканчивается через 3 дня!</strong></h1> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Добрый день, <strong>{firstName}</strong>!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Ваша пробная версия BuroBase истекает через 3 дня. Спасибо за использование BuroBase! Чтобы не потерять информацию и продолжить использование, мы можем предложить Вам несколько вариантов.</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;"> <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Продлить подписку</a> </span> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Если Вы не готовы перейти на платную учетную запись, у нас есть несколько других вариантов, доступных для Вас.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Перезапустите пробную версию</strong> —&nbsp;если вы не получили возможности полностью опробовать BuroBase или вам нужно немного больше времени для оценки, просто сообщите нам об этом. Ответьте на это письмо, и мы продлим Ваш пробный период.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Поделитесь отзывами</strong>&nbsp;—&nbsp;если BuroBase не подходит для Вас. Дайте нам знать, что Вы искали, и мы предложим некоторые альтернативы, которые Вам бы подошли.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Независимо от вашего выбора, мы хотим сказать спасибо за использование BuroBase! С уважением, команда BuroBase.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">P.S. Если у вас есть какие-либо вопросы или нужна помощь, пожалуйста, не стесняйтесь обращаться. Вы можете ответить на это письмо или присоединиться к нам в чате в рабочее время.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">Для связи с нами: +7 495 221 89 91</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">BuroBase © {currentYear} All rights reserved</p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table> </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();


        $id = Template::findOne(['key'=>'invite'])->_id;

        $email = new TemplateEmail();
        $email->subject = 'Вам открыли доступ в базу знаний';
        $email->lang = 'ru';
        $email->templateId = $id;
        $email->affiliateDomain = 'burobase.ru';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;">
                                                                <img src="/images/9691557085610161.png" alt="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="dh7nninkqkqr">
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;">
                                                                <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#3BC7AB;">
                                                                    <strong>Вам открыт доступ в базу знаний</strong></h1></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Добрый день, <strong>{firstName}</strong>!</p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <strong>{senderName}</strong>&nbsp;открыл вам
                                                                    доступ к базе знаний&nbsp;<strong>{baseName}.</strong>&nbsp;Используйте
                                                                    кнопку ниже, чтобы настроить учетную запись и начать
                                                                    совместную работу:</p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                                                <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{confirmationInviteLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Настроить учетную запись</a> </span>
                                                            </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    Если у вас есть какие-либо вопросы или нужна помощь,
                                                                    пожалуйста, не стесняйтесь обращаться. Вы можете
                                                                    написать команде поддержки BuroBase, и мы ответим на
                                                                    все Ваши вопросы!</p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    С уважением, команда BuroBase.</p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    P.S. нужна помощь, чтобы начать? Ознакомьтесь с
                                                                    нашей справочной документацией.</p>
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">
                                                                    <br></p></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    Для связи с нами: +7 495 221 89 91</p></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;">
                                                                <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">
                                                                    BuroBase © 2019 All rights reserved</p></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
            </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();


        $id = Template::findOne(['key'=>'trialPeriodIsOver'])->_id;

        $email = new TemplateEmail();
        $email->subject = 'Пробный период закончился';
        $email->lang = 'ru';
        $email->templateId = $id;
        $email->affiliateDomain = 'burobase.ru';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;"> <img src="/images/9691557085610161.png" alt="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="bl0xqldv32do"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;"> <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;"><strong>Ваша пробная версия BuroBase истекла</strong></h1> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Добрый день, <strong>{firstName}</strong>!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Спасибо за использование BuroBase! Чтобы не потерять информацию и продолжить использование BuroBase, мы можем предложить Вам несколько вариантов.</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;"> <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Продлить подписку</a> </span> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Если Вы не готовы перейти на платную учетную запись, у нас есть несколько других вариантов, доступных для Вас.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Перезапустите пробную версию</strong> —&nbsp;если вы не получили возможности полностью опробовать BuroBase или вам нужно немного больше времени для оценки, просто сообщите нам об этом. Ответьте на это письмо, и мы продлим Ваш пробный период.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Поделитесь отзывами</strong>&nbsp;—&nbsp;если BuroBase не подходит для Вас. Дайте нам знать, что Вы искали, и мы предложим некоторые альтернативы, которые Вам бы подошли.<strong></strong></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">P.S. Если у вас есть какие-либо вопросы или нужна помощь, пожалуйста, не стесняйтесь обращаться. Вы можете ответить на это письмо или присоединиться к нам в чате в рабочее время.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">Для связи с нами: +7 495 221 89 91</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">BuroBase © {currentYear} All rights reserved</p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table> </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();

        $id = Template::findOne(['key'=>'proPeriodIsOver'])->_id;

        $email = new TemplateEmail();
        $email->subject = 'Премиум период закончился';
        $email->lang = 'ru';
        $email->templateId = $id;
        $email->affiliateDomain = 'burobase.ru';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;"> <img src="/images/9691557085610161.png" alt="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="bl0xqldv32do"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;"> <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;"><strong>Ваша премиум подписка BuroBase истекла</strong></h1> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Добрый день, <strong>{firstName}</strong>!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Спасибо за использование BuroBase! Чтобы не потерять информацию и продолжить использование BuroBase, мы можем предложить Вам несколько вариантов.</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;"> <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Продлить подписку</a> </span> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Если Вы не готовы прод учетную запись, у нас есть несколько других вариантов, доступных для Вас.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Перезапустите пробную версию</strong> —&nbsp;если вы не получили возможности полностью опробовать BuroBase или вам нужно немного больше времени для оценки, просто сообщите нам об этом. Ответьте на это письмо, и мы продлим Ваш пробный период.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Поделитесь отзывами</strong>&nbsp;—&nbsp;если BuroBase не подходит для Вас. Дайте нам знать, что Вы искали, и мы предложим некоторые альтернативы, которые Вам бы подошли.<strong></strong></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">P.S. Если у вас есть какие-либо вопросы или нужна помощь, пожалуйста, не стесняйтесь обращаться. Вы можете ответить на это письмо или присоединиться к нам в чате в рабочее время.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">Для связи с нами: +7 495 221 89 91</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">BuroBase © {currentYear} All rights reserved</p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table> </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();


        $id = Template::findOne(['key'=>'tomorrowTheTestPeriodWillEnd'])->_id;

        $email = new TemplateEmail();
        $email->subject = 'Пробный период закончится уже завтра';
        $email->lang = 'ru';
        $email->templateId = $id;
        $email->affiliateDomain = 'burobase.ru';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;"> <img src="/images/9691557085610161.png" alt="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="8ch5q2ganicr"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;"> <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;"><strong>Пробный период заканчивается уже завтра!</strong></h1> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Добрый день, <strong>{firstName}</strong>!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Ваша пробная версия BuroBase истекает уже завтра. Спасибо за использование BuroBase! Чтобы не потерять информацию и продолжить использование, мы можем предложить Вам несколько вариантов.</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;"> <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Продлить подписку</a> </span> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Если Вы не готовы перейти на платную учетную запись, у нас есть несколько других вариантов, доступных для Вас.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Перезапустите пробную версию</strong> —&nbsp;если вы не получили возможности полностью опробовать BuroBase или вам нужно немного больше времени для оценки, просто сообщите нам об этом. Ответьте на это письмо, и мы продлим Ваш пробный период.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Поделитесь отзывами</strong>&nbsp;—&nbsp;если BuroBase не подходит для Вас. Дайте нам знать, что Вы искали, и мы предложим некоторые альтернативы, которые Вам бы подошли.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Независимо от вашего выбора, мы хотим сказать спасибо за использование BuroBase! С уважением, команда BuroBase.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">P.S. Если у вас есть какие-либо вопросы или нужна помощь, пожалуйста, не стесняйтесь обращаться. Вы можете ответить на это письмо или присоединиться к нам в чате в рабочее время.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">Для связи с нами: +7 495 221 89 91</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">BuroBase © {currentYear} All rights reserved</p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table> </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();


        $id = Template::findOne(['key'=>'tomorrowTheProPeriodWillEnd'])->_id;

        $email = new TemplateEmail();
        $email->subject = 'Тарифный план закончится уже завтра';
        $email->lang = 'ru';
        $email->templateId = $id;
        $email->affiliateDomain = 'burobase.ru';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;"> <img src="/images/9691557085610161.png" alt="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="8ch5q2ganicr"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;"> <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;"><strong>Пробный период заканчивается уже завтра!</strong></h1> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Добрый день, <strong>{firstName}</strong>!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Ваша пробная версия BuroBase истекает уже завтра. Спасибо за использование BuroBase! Чтобы не потерять информацию и продолжить использование, мы можем предложить Вам несколько вариантов.</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;"> <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Продлить подписку</a> </span> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Если Вы не готовы перейти на платную учетную запись, у нас есть несколько других вариантов, доступных для Вас.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Перезапустите пробную версию</strong> —&nbsp;если вы не получили возможности полностью опробовать BuroBase или вам нужно немного больше времени для оценки, просто сообщите нам об этом. Ответьте на это письмо, и мы продлим Ваш пробный период.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Поделитесь отзывами</strong>&nbsp;—&nbsp;если BuroBase не подходит для Вас. Дайте нам знать, что Вы искали, и мы предложим некоторые альтернативы, которые Вам бы подошли.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Независимо от вашего выбора, мы хотим сказать спасибо за использование BuroBase! С уважением, команда BuroBase.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">P.S. Если у вас есть какие-либо вопросы или нужна помощь, пожалуйста, не стесняйтесь обращаться. Вы можете ответить на это письмо или присоединиться к нам в чате в рабочее время.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">Для связи с нами: +7 495 221 89 91</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">BuroBase © {currentYear} All rights reserved</p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table> </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();


        $id = Template::findOne(['key'=>'proPeriodWillEndSoon'])->_id;


        $email = new TemplateEmail();
        $email->subject = 'Платный период скоро закончится';
        $email->lang = 'ru';
        $email->templateId = $id;
        $email->affiliateDomain = 'burobase.ru';
        $email->body = '<div class="es-wrapper-color" style="background-color:#FFFFFF;">
    
    <table cellpadding="0" cellspacing="0" class="es-wrapper" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top;">
        <tbody><tr style="border-collapse:collapse;">
            <td valign="top" style="padding:0;Margin:0;">
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;" bgcolor="rgba(0, 0, 0, 0)">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="Margin:0;padding-top:40px;padding-bottom:40px;padding-left:40px;padding-right:40px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="520" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;display:none;"></td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                                <tr style="border-collapse:collapse;">
                                    <td style="Margin:0;padding-top:10px;padding-bottom:10px;padding-left:10px;padding-right:10px;background-color:#FFFFFF;" bgcolor="#ffffff" align="left">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="580" valign="top" align="center" style="padding:0;Margin:0;">
                                                    <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid #EFEFEF;border-right:1px solid #EFEFEF;border-top:1px solid #EFEFEF;border-bottom:1px solid #EFEFEF;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td class="es-m-p0l" align="center" style="Margin:0;padding-bottom:20px;padding-left:20px;padding-right:20px;padding-top:40px;"> <img src="/images/9691557085610161.png" alt="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;" class="adapt-img" width="530" title="Burobase - Сервис по созданию баз знаний для экономии времени и развития команды" data-image="8ch5q2ganicr"></td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="Margin:0;padding-bottom:15px;padding-top:20px;padding-left:40px;padding-right:40px;"> <h1 style="Margin:0;line-height:31px;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:26px;font-style:normal;font-weight:normal;color:#E86D31;"><strong>Пробный период заканчивается через 3 дня!</strong></h1> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Добрый день, <strong>{firstName}</strong>!</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Ваша пробная версия BuroBase истекает через 3 дня. Спасибо за использование BuroBase! Чтобы не потерять информацию и продолжить использование, мы можем предложить Вам несколько вариантов.</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" class="es-m-txt-l" style="Margin:0;padding-top:35px;padding-bottom:40px;padding-left:40px;padding-right:40px;"> <span class="es-button-border" style="border-style:solid;border-color:#2CB543;background:#1F8CEB;border-width:0px 0px 2px 0px;display:inline-block;border-radius:4px;width:auto;border-bottom-width:0px;"> <a href="{paymentLink}" class="es-button" target="_blank" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;font-size:18px;color:#FFFFFF;border-style:solid;border-color:#1F8CEB;border-width:15px 20px;display:inline-block;background:#1F8CEB;border-radius:4px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center;">Продлить подписку</a> </span> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px;padding-left:40px;padding-right:40px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Если Вы не готовы перейти на платную учетную запись, у нас есть несколько других вариантов, доступных для Вас.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Перезапустите пробную версию</strong> —&nbsp;если вы не получили возможности полностью опробовать BuroBase или вам нужно немного больше времени для оценки, просто сообщите нам об этом. Ответьте на это письмо, и мы продлим Ваш пробный период.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><strong>Поделитесь отзывами</strong>&nbsp;—&nbsp;если BuroBase не подходит для Вас. Дайте нам знать, что Вы искали, и мы предложим некоторые альтернативы, которые Вам бы подошли.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">Независимо от вашего выбора, мы хотим сказать спасибо за использование BuroBase! С уважением, команда BuroBase.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;">P.S. Если у вас есть какие-либо вопросы или нужна помощь, пожалуйста, не стесняйтесь обращаться. Вы можете ответить на это письмо или присоединиться к нам в чате в рабочее время.</p><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:\'open sans\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:27px;color:#666666;"><br></p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table>
                <table cellpadding="0" cellspacing="0" class="es-footer" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top;">
                    <tbody><tr style="border-collapse:collapse;">
                        <td align="center" style="padding:0;Margin:0;">
                            <table class="es-footer-body" align="center" cellpadding="0" cellspacing="0" width="600" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;">
                                <tbody><tr style="border-collapse:collapse;">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;">
                                            <tbody><tr style="border-collapse:collapse;">
                                                <td width="560" align="center" valign="top" style="padding:0;Margin:0;">
                                                    <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;">
                                                        <tbody><tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">Для связи с нами: +7 495 221 89 91</p> </td>
                                                        </tr>
                                                        <tr style="border-collapse:collapse;">
                                                            <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:\'source sans pro\', \'helvetica neue\', helvetica, arial, sans-serif;line-height:21px;color:#A9A9A9;">BuroBase © {currentYear} All rights reserved</p> </td>
                                                        </tr>
                                                    </tbody></table> </td>
                                            </tr>
                                        </tbody></table> </td>
                                </tr>
                            </tbody></table> </td>
                    </tr>
                </tbody></table> </td>
        </tr>
    </tbody></table>
</div>';
        $email->save();
    }
}
