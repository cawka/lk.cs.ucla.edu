<link rel="stylesheet" href="{$GLOBAL_PREFIX}css/{$SETTINGS.theme}/diff.css" type="text/css" />

{eval var=$this->myHelper->diff($this->myData.text_orig,$this->myData.text)}
