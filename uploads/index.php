<?php
// Protege a pasta uploads
http_response_code(403);
echo "Acesso negado.";
exit; ?>