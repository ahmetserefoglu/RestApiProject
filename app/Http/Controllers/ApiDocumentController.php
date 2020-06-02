<?php

namespace App\Http\Controllers;

class ApiDocumentController extends Controller {
	//
	/**
	 * @SWG\Swagger(
	 *     @SWG\Info(
	 *          version="1.0.0",
	 *          title="API",
	 *          description="API Documentation"
	 *     )
	 * )
	 */

	/** @SWG\Post(
	 *     path="/api/login",
	 *     tags={"Login"},
	 *     summary="Login işlemi",
	 *     description="Login işlemi",
	 *     @SWG\Parameter(
	 *          name="email",
	 *          description="User e-mail address",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
	 *     @SWG\Parameter(
	 *          name="password",
	 *          description="User password",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description="login is successful",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="token",
	 *                  type="string"
	 *             )
	 *          )
	 *     ),
	 *     @SWG\Response(
	 *          response=401,
	 *          description="Unauthorized"
	 *     )
	 * )
	 */

	/** @SWG\Get(
	 *     path="/api/profile",
	 *     tags={"Profil"},
	 *     summary="Profil bilgisi",
	 *     description="Profil bilgisi",
	 *     @SWG\Parameter(
	 *          name="token",
	 *          description="User token",
	 *          required=true,
	 *          type="string",
	 *          in="header"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description="profile data",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="user_id",
	 *                  type="integer"),
	 *              @SWG\Property(
	 *                  property="name_surname",
	 *                  type="string"),
	 *              @SWG\Property(
	 *                  property="age",
	 *                  type="integer"
	 *             )
	 *         )
	 *     ),
	 *     @SWG\Response(
	 *          response=401,
	 *          description="Unauthorized"
	 *     )
	 * )
	 */
}
