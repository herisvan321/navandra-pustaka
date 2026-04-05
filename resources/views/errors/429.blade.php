@extends('errors::minimal')

@section('title', __('Terlalu Banyak Permintaan'))
@section('code', '429')
@section('message', __('Permintaan Anda terlalu banyak. Silakan coba lagi nanti.'))
@section('subtitle', __('Tunggu beberapa saat sebelum mencoba lagi untuk menghindari pembatasan.'))
