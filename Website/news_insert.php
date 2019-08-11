<form method="post" action="news_insert_action.php" enctype="multipart/form-data">
<table width="100%" border="0">
  <tr>
    <td>Title of the Story: </td>
    <td><textarea rows="5" cols="100" name="title"></textarea></td>
  </tr>
  <tr>
  <tr>
    <td>Type: </td>
    <td><select name="type">
    		<option value="1">Stories</option>
            <option value="2">news</option>
            <option value="3">featured</option>
            </select>
  </tr>
  <tr>
    <td>Related to game or other: </td>
    <td><input type="text" name="rel_to" /></td>
  </tr>
  <tr>
    <td>Dated: </td>
    <td><input type="text" name="date" /></td>
  </tr>
  <tr>
    <td>Top Image: </td>
    <td><input type="file" name="file" id="file"></td>
  </tr>
  <tr>
    <td>Page Details: </td>
    <td><textarea rows="15" cols="100" name="page"></textarea></td>
  </tr>
</table>
<input type="submit" value="submit" />
</form>
