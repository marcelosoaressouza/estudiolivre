{* $Header: /cvsroot/tikiwiki/tiki/templates/mail/user_watch_image_gallery_upload.tpl,v 1.1.2.1 2007/05/01 21:48:31 sylvieg Exp $ *}
{tr}A new file was posted to image gallery{/tr}: {$galleryName}

{tr}Posted by{/tr}: {$author}
{tr}Date{/tr}: {$mail_date|tiki_short_datetime}
{tr}Name{/tr}: {$fname}
{tr}File Name{/tr}: {$filename}
{tr}File Description{/tr}: {$description}

You can see the new image at:
{$mail_machine}/tiki-browse_image.php?galleryId={$galleryId}&amp;imageId={$imageId}
