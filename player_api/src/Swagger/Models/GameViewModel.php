<?php


namespace gq\player\Swagger\Models;

/**
 * @OA\Schema(
 *     title="GameViewModel",
 *     description="Creation d'une partie",
 * )
 *
 */
class GameViewModel
{
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
    public $serieId;
}