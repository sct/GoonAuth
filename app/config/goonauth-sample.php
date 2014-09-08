<?php

return array(

	/**
	 * Site title. Shows up in navbar and page titles.
	 */
	'title' => 'AA Goons',

	/**
	 * Prefix applied to the front of unique ids used for authenticating SA accounts
	 */
	'codePrefix' => 'aagoons',

	/**
	 * Your SA bbuserid cookie value. Required to auth accounts.
	 */
	'bbuserid' => '',

	/**
	 * Your SA bbpassword cookie value. Required to auth accounts.
	 */
	'bbpassword' => '',

	/**
	 * URL to your Xenforo api.php
	 */
	'apiUrl' => '',

	/**
	 * URL to your forums
	 */
	'forumUrl' => '',

	/**
	 * Xenforo API key
	 */
	'apiKey' => '',

	/**
	 * Xenforo usergroup for authed goons
	 */
	'authId' => 5,

	/**
	 * Xenforo usergroup for sponsored goons
	 */
	'sponsorId' => 6,

	/**
	 * Number of characters an authed goon can have. This includes the main.
	 */
	'characters' => 3,

	/**
	 * Number of characters a sponsored player can have.
	 */
	'sponsored' => 1,

	/**
	 * Number of players an authed goon can sponsor
	 */
	'sponsors' => 2,

	/**
	 * Super Admin IDs (These users can grant other users admin)
	 */
	'superAdmins' => array(1,2),

);
