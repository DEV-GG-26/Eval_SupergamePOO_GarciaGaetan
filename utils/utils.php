<?php

/*créez une fonction sanitize(). Elle 
prend une $data en paramètre sous forme de chaîne de caractère, lui applique la fonction 
trim(), puis retourne $data.*/


function sanitize( string $data): string{
    trim($data);
    return $data;
}

?>