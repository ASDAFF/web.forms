<?
$events = GetModuleEvents("multiline.ml2webforms", "OnModuleUnInstall");
while($arEvent = $events->Fetch())
{
	if(strlen($arEvent["TO_CLASS"]) <= 0)
		$arEvent["CALLBACK"] = $arEvent["TO_METHOD"];
	ExecuteModuleEvent($arEvent);
}

if ($ex = $APPLICATION->GetException())
{
	echo CAdminMessage::ShowMessage(GetMessage("ML2WEBFORMS_INSTALL_UNPOSSIBLE")."<br />".$ex->GetString());
	?>
	<form action="<?echo $APPLICATION->GetCurPage()?>">
	<p>
		<input type="hidden" name="lang" value="<?echo LANG?>">
		<input type="submit" name="" value="<?echo GetMessage("MOD_BACK")?>">	
	</p>
	<form>
	<?
}
else
{
	?>
	<form action="<?echo $APPLICATION->GetCurPage()?>">
	<?=bitrix_sessid_post()?>
		<input type="hidden" name="lang" value="<?echo LANG?>">
		<input type="hidden" name="id" value="multiline.ml2webforms">
		<input type="hidden" name="uninstall" value="Y">
		<input type="hidden" name="step" value="2">
		<?CAdminMessage::ShowMessage(GetMessage("MOD_UNINST_WARN"))?>
		<p><?echo GetMessage("MOD_UNINST_SAVE")?></p>
		<p><input type="checkbox" name="savedata" id="savedata" value="Y" checked><label for="savedata"><?echo GetMessage("ML2WEBFORMS_UNINSTALL_SAVETABLE")?></label></p>
		<input type="submit" name="inst" value="<?echo GetMessage("MOD_UNINST_DEL")?>">
	</form>
	<?
}
?>