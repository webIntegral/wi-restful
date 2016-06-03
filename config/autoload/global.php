<?php
return array(
    'zf-mvc-auth' => array(
        'authentication' => array(
            'map' => array(
                'WiContactAPI\\V1' => 'oauth2_doctrine',
                'WiUserAPI\\V1' => 'oauth2_doctrine',
            ),
        ),
    ),
);
