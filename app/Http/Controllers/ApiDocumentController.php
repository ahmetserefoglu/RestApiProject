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
	 *          description="Code Send",
	 *     ),
	 *     @SWG\Response(
	 *          response=401,
	 *          description="Unauthorized and Email,Password Control"
	 *     )
	 * )
	 */

	/** @SWG\Get(
	 *     path="/api/auth/login/verify",
	 *     tags={"Login Verify"},
	 *     summary="Login Verify Operation",
	 *     description="Login Verify Operation",
	 *     @SWG\Parameter(
	 *          name="code",
	 *          description="Code",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
	 *	   @SWG\Response(
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
	 *     path="/api/auth/email/verify",
	 *     tags={"Email Verify"},
	 *     summary="Email Verify Operation",
	 *     description="Email Verify Operation",
	 *     @SWG\Parameter(
	 *          name="id",
	 *          description="User id",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description="verify is successful",
	 *     ),
	 *     @SWG\Response(
	 *          response=401,
	 *          description="Unauthorized"
	 *     )
	 * )
	 */

	/** @SWG\Get(
	 *     path="/api/auth/email/resend",
	 *     tags={"Resend"},
	 *     summary="Resend Operation",
	 *     description="Resend Operation",
	 *     @SWG\Parameter(
	 *          name="email",
	 *          description="Email",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description="resend is successful",
	 *     ),
	 *     @SWG\Response(
	 *          response=400,
	 *          description="Email kayıtlı Değil"
	 *     ),
	 *     @SWG\Response(
	 *          response=422,
	 *          description="Daha Önceden Email Doğrulandı "
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

	/** @SWG\Post(
	 *     path="/api/password/sendtoken",
	 *     tags={"Token for Reset Password "},
	 *     summary="Reset Password Operation",
	 *     description="Reset Password Operation",
	 *     @SWG\Parameter(
	 *          name="email",
	 *          description="Email",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description="Reset Password  is successful",
	 *     ),
	 *     @SWG\Response(
	 *          response=404,
	 *          description="Find'not Email"
	 *     )
	 * )
	 */

	/** @SWG\Get(
	 *     path="/api/password/find",
	 *     tags={"User Token Find"},
	 *     summary="User Token Find",
	 *     description="User Token Find",
	 *     @SWG\Parameter(
	 *          name="token",
	 *          description="User token",
	 *          required=true,
	 *          type="string",
	 *          in="header"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description="Success",
	 *     ),
	 *     @SWG\Response(
	 *          response=404,
	 *          description="Invalid Token"
	 *     )
	 * )
	 */

	/** @SWG\Post(
	 *     path="/api/password/resetpassword",
	 *     tags={"Password Change Operation "},
	 *     summary="Password Change Operation",
	 *     description="Password Change Operation",
	 *     @SWG\Parameter(
	 *          name="email",
	 *          description="email",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
	 *     @SWG\Parameter(
	 *          name="token",
	 *          description="token",
	 *          required=true,
	 *          type="string",
	 *          in="query"
	 *     ),
	 *     @SWG\Response(
	 *          response=200,
	 *          description=" Password Change  is successful",
	 *     ),
	 *     @SWG\Response(
	 *          response=404,
	 *          description="Find'not User"
	 *     )
	 * )
	 */

}
