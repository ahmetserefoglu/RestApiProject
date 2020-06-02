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
	 *     path="/api/auth/register",
	 *     tags={"Register"},
	 *     summary="Register Operation",
	 *     description="Register Operation",
	 *	   @SWG\Parameter(
	 *          name="name",
	 *          description="User Name",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
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
	 *      @SWG\Response(
	 *          response=201,
	 *          description="Register is Successfully"
	 *     ),
	 *     @SWG\Response(
	 *          response=400,
	 *          description="Validate Error"
	 *     )
	 * )
	 */

	/** @SWG\Post(
	 *     path="/api/auth/login",
	 *     tags={"Login"},
	 *     summary="Login Operation",
	 *     description="Login Operation",
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
	 *					description = "User Token",
	 *                  type="string"
	 *              ),
	 *				@SWG\Property(
	 *                  property="experies_at",
	 *                  type="string",
	 *					description="Token delete date"	
	 *              ),
	 *				 @SWG\Property(
	 *                  property="token_type",
	 *                  type="string",
	 *					description="Bearer"	
	 *             ),
	 *          )
	 *     ),
	 *     @SWG\Response(
	 *          response=401,
	 *          description="Unauthorized"
	 *     )
	 * )
	 */

	/** @SWG\Post(
	 *     path="/api/auth/logout",
	 *     tags={"Logout"},
	 *     summary="Logout Operation",
	 *     description="Logout Operation",
	 *     @SWG\Parameter(
	 *          name="token",
	 *          description="Token",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description="Logout is successful",
	 *     ),
	 *     @SWG\Response(
	 *          response=401,
	 *          description="Unauthorized"
	 *     )
	 * )
	 */

	/** @SWG\Get(
	 *     path="/api/auth/me",
	 *     tags={"User Info"},
	 *     summary="User Info",
	 *     description="User Info",
	 *     @SWG\Parameter(
	 *          name="token",
	 *          description="User token",
	 *          required=true,
	 *          type="string",
	 *          in="header"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description="User Info",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="name",
	 *                  type="string"),
	 *              @SWG\Property(
	 *                  property="email",
	 *                  type="string"),
	 *              @SWG\Property(
	 *                  property="password",
	 *                  type="string"
	 *             )
	 *         )
	 *     ),
	 *     @SWG\Response(
	 *          response=401,
	 *          description="Unauthorized"
	 *     )
	 * )
	 */

	/** @SWG\Get(
	 *     path="/api/auth/users",
	 *     tags={"Users All"},
	 *     summary="Users All",
	 *     description="Users All",
	 *     @SWG\Parameter(
	 *          name="token",
	 *          description="User token",
	 *          required=true,
	 *          type="string",
	 *          in="header"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description="users data",
	 *          @SWG\Schema(
	 *              type="object",
	 *              @SWG\Property(
	 *                  property="name",
	 *                  type="string"),
	 *              @SWG\Property(
	 *                  property="email",
	 *                  type="string"),
	 *              @SWG\Property(
	 *                  property="password",
	 *                  type="string"
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
