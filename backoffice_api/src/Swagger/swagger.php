<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="GeoQuizz",
 *     version="1.0",
 *     description="GeoQuizz : Back-office",
 *     @OA\Contact(
 *          email="elrhomari.younes@gmail.com"
 *      ),
 *      @OA\Server(
 *          url="http://api.backoffice.local:19080",
 *          description="API Back-Office"
 *      )
 * )

 */
/**
 * @OA\Tag(
 *     name="user",
 *     description="Login et Inscription"
 * )
 * @OA\Tag(
 *     name="photo",
 *     description="Ajout photo, affectation photo à une serie, recuperation des photos prises par l'utilisateur"
 * )
 * @OA\Tag(
 *     name="serie",
 *     description="Recuperer les difficultés, les series et l'ajout d'une nouvelle serie"
 * )
 */
