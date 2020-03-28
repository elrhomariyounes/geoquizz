<?php


namespace gq\player\Swagger\Models;

/**
 * @OA\Schema(
 *     title="Game",
 *     description="Partie",
 * )
 *
 */
class Game
{
    /**
     * @OA\Property(
     *     description="Game id",
     *     title="Game Id",
     * )
     *
     * @var string
     */
    public $id;
    /**
     * @OA\Property(
     *     description="Pseudo du joueur",
     *     title="Player Pseudo",
     * )
     *
     * @var string
     */
    public $player;
    /**
     * @OA\Property(
     *     format="2",
     *     description="Serie id",
     *     title="Serie Id",
     * )
     *
     * @var int
     */
    public $serie_id;
    /**
     * @OA\Property(
     *     format="2",
     *     description="Nombre de photos dans la partie",
     *     title="Number of Game Photos",
     * )
     *
     * @var int
     */
    public $nb_photos;
    /**
     * @OA\Property(
     *     description="Ce token doit être associé à toutes les autres pour pouvoir identifier la partie",
     *     title="Game Token",
     * )
     *
     * @var string
     */
    public $token;
}