<?php

namespace App\Controllers;

use App\Models\MasjidModel;
use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $masjidModel;
    protected $usersModel;

    public function __construct()
    {
        $this->masjidModel = new MasjidModel();
        $this->usersModel = new UsersModel();
    }

    public function index(): string
    {
        return view('auth/login_pages');
    }

    public function proses_login()
    {
        if (isset($_POST['loginformmasjid'])) {

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
            ]);
            if (!$valid) {
                $this->session->setFlashdata('gagal', $validation->getError('username') . " " . $validation->getError('password'));
                return redirect()->to('/login-masjid')->withInput();
                // return redirect()->to('/people/edit/' . $this->request->getVar('slug'))->withInput()
            } else {
                $username = $this->request->getPost('username');
                $cek_user = $this->usersModel->where('username', $username)->countAllResults();
                if ($cek_user > 0) {
                    $user_row = $this->usersModel->where('username', $username)->first();
                    $password = $this->request->getPost('password');
                    if (password_verify(strval($password), $user_row['password'])) {
                        return  $this->generate_session($user_row['id'], $user_row['username'], $user_row['nama_pengguna'], $user_row['email_pengguna'], $user_row['alamat_pengguna'], $user_row['lembaga_pengguna'], $user_row['level']);
                    } else {
                        $this->session->setFlashdata('gagal', "Ops Password salah ...");
                        return redirect()->to('/login-masjid')->withInput();
                    }
                } else {
                    $this->session->setFlashdata('gagal', "Username belum terdaftar");
                    return redirect()->to('/login-masjid')->withInput();
                }


                // $user = $this->request->getPost('uname');
                // $input_pass = $this->request->getPost('kunci');
                // $cek_user = $this->penggunaModel->where('username', $user)->countAllResults();

                // if ($cek_user > 0) {
                //     $user_row = $this->penggunaModel->where('username', $user)->first();
                //     $pass = $user_row['password'];
                //     if ($pass == md5(strval($input_pass))) {
                //         $_SESSION['token_kurikulum'] =  "-";
                //         // cek jabatan
                //         if ($user_row['tipe_pengguna'] == 'DOSEN') {
                //             // update prodi dosen jika belum pernah diupdate
                //             if ($user_row['kode_prodi'] == 'dosen') {
                //                 $detail_dosen = get_detail_dosen($user_row['id_pengguna']);
                //                 if ($detail_dosen['success'] == true) {
                //                     $kode_lembaga = $detail_dosen['rows']['home_id'];
                //                     $lembaga = $this->lembagaModel->where('id_lembaga', $kode_lembaga)->first();
                //                     $kode_prodi = $lembaga['kode_prodi'];
                //                     $this->penggunaModel->update_kodeprodi($user_row['id_pengguna'], $kode_prodi);
                //                 } else {
                //                     $kode_prodi = 'dosen';
                //                 }
                //             } else {
                //                 $kode_prodi = $user_row['kode_prodi'];
                //             }

                //             // Cek apakah kaprodi atau sekprodi di tabel jabatan
                //             $find_prodi = $this->jabatanModel->where('uniid_penjabat', $user_row['id_pengguna'])->whereIn('jabatan', ['Kaprodi', 'Sekprodi'])->countAllResults();
                //             if ($find_prodi > 0) {
                //                 $jabatan = $this->jabatanModel->whereIn('jabatan', ['Kaprodi', 'Sekprodi'])
                //                     ->where('uniid_penjabat', $user_row['id_pengguna'])
                //                     ->join('mstr_lembaga as lmbg', 'mstr_jabatan.kode_lembaga = lmbg.id_lembaga')->first();
                //                 $kode_lembaga = $jabatan['kode_lembaga'];
                //                 $kode_prodi = $jabatan['kode_prodi'];
                //                 $kode_user = 8; // 8 = dosen
                //                 $kaprodi = 1; // kaprodi true false
                //                 $_SESSION['token_kurikulum'] =  get_token_kurikulum()['access'];
                //             } else {
                //                 $delegasi = $this->delegasiModel
                //                     ->join('mstr_lembaga', 'delegasi.idlembaga = mstr_lembaga.id_lembaga')
                //                     ->where(['iddosen' => $user_row['id_pengguna'], 'jabatan' => 'kaprodi'])->first();
                //                 if (!empty($delegasi)) {
                //                     //jika didelegasikan sbg kaprodi
                //                     $kode_lembaga = $delegasi['idlembaga'];
                //                     $kode_prodi = $delegasi['kode_prodi'];
                //                     $kode_user = 8;
                //                     $kaprodi = 2;
                //                     $_SESSION['token_kurikulum'] =  get_token_kurikulum()['access'];
                //                 } else {
                //                     $kode_prodi = $kode_prodi;
                //                     $lembaga = $this->lembagaModel->where('kode_prodi', $kode_prodi)->first();
                //                     $kode_lembaga = $lembaga['id_lembaga'];
                //                     $kode_user = 8;
                //                     $kaprodi = 0;
                //                 }
                //             }
                //         } elseif ($user_row['tipe_pengguna'] == 'MAHASISWA') {
                //             $kode_prodi = $user_row['kode_prodi'];
                //             $lembaga = $this->lembagaModel->where('kode_prodi', $kode_prodi)->first();
                //             $kode_lembaga = $lembaga['id_lembaga'];
                //             $kode_user = 10;
                //             $kaprodi = 0;
                //         } elseif ($user_row['tipe_pengguna'] == 'SUPERADMIN') {
                //             $kode_lembaga = $user_row['kode_prodi'];
                //             $kode_prodi = 0;
                //             $kode_user = 1;
                //             $_SESSION['token_kurikulum'] =  get_token_kurikulum()['access'];
                //             $kaprodi = 0;
                //         } elseif ($user_row['tipe_pengguna'] == 'ADMIN') {
                //             $kode_lembaga = $user_row['kode_prodi'];
                //             $kode_prodi = 0;
                //             $kode_user = 2;
                //             $_SESSION['token_kurikulum'] =  get_token_kurikulum()['access'];
                //             $kaprodi = 0;
                //         }

                //         // cek apakah user sebagai UJM atau tidak
                //         $count_delegasi_ujm = $this->delegasiModel
                //             ->where(['iddosen' => $user_row['id_pengguna'], 'jabatan' => 'ujm'])
                //             ->countAllResults();
                //         $is_ujm = 0;
                //         if ($count_delegasi_ujm >= 1) {
                //             $is_ujm = 1;
                //         }


                //         // generate session
                //         $data_session = [
                //             'login' => true,
                //             'kode_jabatan' => $kode_user,
                //             'kaprodi' => $kaprodi,
                //             'nama_user' => $user_row['nama_pengguna'],
                //             'id_pengguna' => $user_row['id_pengguna'],
                //             'kode_prodi' => $kode_prodi,
                //             'kode_lembaga' => $kode_lembaga,
                //             'is_ujm' => $is_ujm
                //         ];
                //         $_SESSION['userdata'] =  $data_session;

                //         $timeNow = Time::now('Asia/Jakarta', 'en_US');
                //         $kode_sync = $timeNow->getTimestamp();
                //         $token = md5($user_row['id_pengguna'] . $kode_sync . 'purwostwn');
                //         $nama = nama_depanbelakang($user_row['nama_pengguna']);
                //         $nama_depan = $nama[0];
                //         $nama_belakang = $nama[1];
                //         $this->loginmoodleModel->simpan($token, $user_row['username'], 'purwostwn', $nama_depan, $nama_belakang, $user_row['email_pengguna'], $user_row['id_pengguna'], 0);
                //         $_SESSION['token_moodle'] =  $token;
                //     } else {
                //         $this->session->setFlashdata('errorPassword', "Password salah");
                //         return redirect()->to('/')->withInput();
                //     }
                // } else {
                //     $this->session->setFlashdata('errorUser', "Username tidak ditemukan!");
                //     return redirect()->to('/')->withInput();
                // }

                // if ($_SESSION['userdata']['kode_jabatan'] == 1) {
                //     return redirect()->to('/home_adm');
                // } elseif ($_SESSION['userdata']['kode_jabatan'] == 2) {
                //     return redirect()->to('/admin/dashboard-fakultas');
                // } elseif ($_SESSION['userdata']['kode_jabatan'] == 8) {
                //     return redirect()->to('/dosen/home');
                // } elseif ($_SESSION['userdata']['kode_jabatan'] == 10) {
                //     return redirect()->to('/mhs/home');
                // }
            }
        }
    }

    public function generate_session($id_pengguna, $username, $nama_pengguna, $email_pengguna, $alamat_pengguna, $lembaga_pengguna, $level)
    {
        if ($level == "superadmin") {
            $kode_level = 100;
        } elseif ($level == "admin") {
            $kode_level = 80;
        }
        $data_session = [
            'login' => true,
            'id_pengguna' => $id_pengguna,
            'username' => $username,
            'nama_pengguna' => $nama_pengguna,
            'email_pengguna' => $email_pengguna,
            'alamat_pengguna' => $alamat_pengguna,
            'lembaga_pengguna' => $lembaga_pengguna,
            'kode_level' => $kode_level
        ];
        $_SESSION['userdata'] =  $data_session;
        if ($kode_level == 100) {
            return redirect()->to('/admin/dashboard');
        } elseif ($kode_level == 80) {
            return redirect()->to('/admin/dashboard');
        }
    }
}
