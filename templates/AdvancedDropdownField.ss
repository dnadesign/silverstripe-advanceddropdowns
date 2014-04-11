<select $AttributesHTML>
<% loop $Options %>
	<option value="$Value.XML"<% if $Selected %> selected="selected"<% end_if %><% if $Disabled %> disabled="disabled"<% end_if %><% loop $Attributes %>$Name="$Value"<% end_loop %>>$Title.XML</option>
<% end_loop %>
</select>

