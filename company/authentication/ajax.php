<?php
if (isset($_GET['request_url'])) echo file_get_contents($_GET['request_url']);