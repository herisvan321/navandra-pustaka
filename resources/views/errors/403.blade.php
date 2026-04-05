@extends('errors::minimal')

@section('title', __('Akses Ditolak'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Anda tidak memiliki izin untuk melihat halaman ini.'))
@section('subtitle', __('Jika Anda merasa ini kesalahan, silakan hubungi administrator atau coba kembali nanti.'))
