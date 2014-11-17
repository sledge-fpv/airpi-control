<?php
function runCommand($command, $answer_required = FALSE)
{
	if(!$answer_required)
		$command = $command." > /dev/null &";
	return exec($command, $ret);
}

function shellCmd($command, $answer_required = FALSE)
{
	return runCommand($command, $answer_required);
}

function getYesNo()
{
	$row = "<tr>
				<td><button type='submit' name='do' value='yes'>YES</button></td>
				<td><button type='submit' name='do' value='no'>NO</button></td>
			</tr>";
	return $row;
}

?>