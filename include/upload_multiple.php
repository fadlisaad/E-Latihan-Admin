<?php
    /**
	 * Copyright 2009-2011 MARDI
	 * Developed by: Mohd Fadli Saad, ZNA System Sdn Bhd
	 * This file is part of MARDILMS.
	 * The latest code can be found at http://elearn.mardi.gov.my/
	 * 
	 * Description : upload multiple files form.
	 */
?>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form action="upload_multiple_process.php" method="post" enctype="multipart/form-data" name="upload" id="upload">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td><strong>Upload file(s)</strong></td>
</tr>
<tr>
<td>Select file
<input name="ufile[]" type="file" id="ufile[]" size="50" /></td>
</tr>
<tr>
<td>Select file
<input name="ufile[]" type="file" id="ufile[]" size="50" /></td>
</tr>
<tr>
<td>Select file
<input name="ufile[]" type="file" id="ufile[]" size="50" /></td>
</tr>
<tr>
<td align="center"><input type="submit" name="Submit" value="Upload" /></td>
</tr>
</table>
</td>
</form>
</tr>
</table>