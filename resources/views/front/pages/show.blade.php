@extends('front.layouts.app')

@section('title', $page->seoMeta?->meta_title ?? $page->title.' - '.$siteSettings['site_name'])
@section('meta_description', $page->seoMeta?->meta_description ?? Str::limit(strip_tags($page->content), 160))

@section('content')
    <div class="bg-light py-5">
        <div class="container text-center">
            <h1 class="section-title">{{ $page->title }}</h1>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="page-content">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
