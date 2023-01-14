<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Utils\HttpCode;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
  public function Create(Request $request)
  {
    $createOrder = $request->all();
    $validation = Validator(
      $createOrder,
      [
        'id_user' => [
          'required',
          'integer',
          'exists:user,id_user',
          Rule::prohibitedIf(
            !empty($createOrder['id_user']) ?
              (empty(User::find($createOrder['id_user'])) ||
                User::find($createOrder['id_user'])->id_role != 7) :
              false
          ),
        ],
      ],
      [
        'id_user.required' => 'ID User Tidak Boleh Kosong !',
        'id_user.integer' => 'ID User Harus Berupa Angka !',
        'id_user.exists' => 'ID User Tidak Ditemukan !',
        'id_user.prohibited' => 'ID User Hanya Untuk Pemilik Order !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      $order = Order::create($createOrder);
      $order = Order::find($order->id_order);

      $response = array(
        'message' => 'Data Order Baru Berhasil Dibuat !',
        'order' => $order,
      );

      return response(
        $response,
        HttpCode::$created
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Order Baru Gagal Dibuat !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Read()
  {
    $order = Order::all();

    if (count($order) < 1) {
      return response(
        ['message' => 'Tidak Ada Data Order !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Semua Data Order !',
        'order' => $order
      ],
      HttpCode::$ok
    );
  }

  public function Update(Request $request, $id)
  {
    $order_old = Order::find($id);
    $order_new = Order::find($id);

    if (empty($order_old)) {
      return response(
        ['message' => 'Data Order Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    $updateOrder = $request->all();
    $validation = Validator(
      $updateOrder,
      [
        'status' => [
          'nullable',
          Rule::in(['Gagal', 'Berhasil']),
        ],
      ],
      [
        'status.in' => 'Status Harus Salah Satu Dari (Gagal, Berhasil) !',
      ]
    );

    if ($validation->fails()) {
      return response(
        ['message' => $validation->errors()],
        HttpCode::$not_acceptable
      );
    }

    try {
      if (!empty($updateOrder['status'])) {
        $order_new->status = $updateOrder['status'];

        if ($updateOrder['status'] == 'Berhasil') {
          $order_new->tanggal_konfirmasi = Carbon::now();
        }
      }

      $order_new->save();
      $order_new = Order::find($id);

      return response(
        [
          'message' => 'Data Order Berhasil Diubah !',
          'order_old' => $order_old,
          'order_new' => $order_new,
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Order Gagal Diubah !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Delete($id)
  {
    $order_old = Order::find($id);
    $order_new = Order::find($id);

    if (empty($order_old)) {
      return response(
        ['message' => 'Data Order Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    try {
      $order_new->delete();

      return response(
        [
          'message' => 'Data Order Berhasil Dihapus !',
          'order_old' => $order_old
        ],
        HttpCode::$ok
      );
    } catch (Exception $error) {
      return response(
        [
          'message' => 'Data Order Gagal Dihapus !',
          'error' => $error->getMessage()
        ],
        HttpCode::$bad_request
      );
    }
  }

  public function Search($id)
  {
    $order = Order::find($id);

    if (empty($order)) {
      return response(
        ['message' => 'Data Order Tidak Ditemukan !'],
        HttpCode::$not_found
      );
    }

    return response(
      [
        'message' => 'Menampilkan Data Order !',
        'order' => $order,
      ],
      HttpCode::$ok
    );
  }
}
