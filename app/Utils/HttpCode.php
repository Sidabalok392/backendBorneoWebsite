<?php

namespace App\Utils;

class HttpCode
{
  //1XX Informational
  public static $continue = 100;
  public static $switching_protocols = 101;
  public static $processing = 102;

  //2XX Success
  public static $ok = 200;
  public static $created = 201;
  public static $accepted = 202;
  public static $non_authoritative_information = 203;
  public static $no_content = 204;
  public static $reset_content = 205;
  public static $partial_content = 206;
  public static $multi_status = 207;
  public static $already_reported = 208;
  public static $im_used = 226;

  //3XX Redirectional
  public static $multiple_choices = 300;
  public static $moved_permanently = 301;
  public static $found = 302;
  public static $see_other = 303;
  public static $not_modified = 304;
  public static $use_proxy = 305;
  public static $temporary_redirect = 307;
  public static $permanent_redirect = 308;

  //4XX Client Error
  public static $bad_request = 400;
  public static $unauthorized = 401;
  public static $payment_required = 402;
  public static $forbidden = 403;
  public static $not_found = 404;
  public static $method_not_allowed = 405;
  public static $not_acceptable = 406;
  public static $proxy_authentication_required = 407;
  public static $request_timeout = 408;

  //4XX Client Error Continued
  public static $conflict = 409;
  public static $gone = 410;
  public static $length_required = 411;
  public static $precondition_failed = 412;
  public static $payload_too_large = 413;
  public static $request_uri_too_long = 414;
  public static $unsupported_media_type = 415;
  public static $requested_range_not_satisfiable = 416;
  public static $expectation_failed = 417;
  public static $im_a_teapot = 418;
  public static $misdirected_request = 421;
  public static $unprocessable_entity = 422;
  public static $locked = 423;
  public static $failed_dependency = 424;
  public static $upgrade_required = 426;
  public static $precondition_required = 428;
  public static $too_many_requests = 429;
  public static $request_header_fields_too_large = 431;
  public static $connection_closed_without_response = 444;
  public static $unavailable_for_legal_reasons = 451;
  public static $client_closed_request = 499;

  //5XX Server Error
  public static $internal_server_error = 500;
  public static $not_implemented = 501;
  public static $bad_gateway = 502;
  public static $service_unavailable = 503;
  public static $gateway_timeout = 504;
  public static $http_version_not_supported = 505;
  public static $variant_also_negotiates = 506;
  public static $insufficient_storage = 507;
  public static $loop_detected = 508;
  public static $not_extended = 510;
  public static $network_authentication_required = 511;
  public static $network_connect_timeout_error = 599;
}
