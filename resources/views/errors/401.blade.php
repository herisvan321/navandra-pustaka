@extends('errors::minimal')

@section('title', __('Tidak Terotorisasi'))
@section('code', '401')
@section('message', __('Anda tidak memiliki izin untuk mengakses halaman ini.'))
@section('subtitle', __('Periksa kembali hak akses Anda atau hubungi administrator untuk mendapatkan izin.'))
