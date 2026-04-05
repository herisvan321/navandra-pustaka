@extends('errors::minimal')

@section('title', __('Kesalahan Server'))
@section('code', '500')
@section('message', __('Terjadi kesalahan pada server. Silakan coba lagi nanti.'))
@section('subtitle', __('Tim kami sedang memeriksa masalah ini. Silakan kembali sebentar lagi.'))
