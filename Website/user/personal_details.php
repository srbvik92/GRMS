<form method="post" action="update_details.php">
 <table width="800" border="0">
  <tbody>
    <tr>
      <td>Name:</td>
      <td><input type="text" name="name"></td>
    </tr>
    <tr>
      <td>Date of Birth:</td>
      <td><input type="date" name="dob"></td>
    </tr>
    <tr>
      <td>Nation</td>
      <td>
      	<select name="nation">
      		<option value="usa">United States</option>
      		<option value="india">India</option>
      		
      		
      	</select>
      </td>
    </tr>
    <tr>
      <td>Sex:</td>
      <td><select name="sex">
      	<option value="m">Male</option>
      	<option value="f">Female</option>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="submit" value="submit"></td>
    </tr>
  </tbody>
</table>
</form>