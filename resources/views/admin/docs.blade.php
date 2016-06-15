@extends('comments::admin.layout')
@section('title') Documentation @stop
@section('content')
<div id="documnetation">
    <ul class="nav nav-tabs">
        <li v-class="disabled: loading" class="active"><a href="#installation" data-toggle="tab">Installation</a></li>
        <li v-class="disabled: loading"><a href="#configuration" data-toggle="tab">Configuration</a></li>
        <li v-class="disabled: loading"><a href="#usage" data-toggle="tab">Usage</a></li>
        <li v-class="disabled: loading"><a href="#events" data-toggle="tab">Events</a></li>
        <li v-class="disabled: loading"><a href="#customization" data-toggle="tab">Customization</a></li>
        <li v-class="disabled: loading"><a href="#debugging" data-toggle="tab">Debugging</a></li>
    </ul>
    <div class="tab-content">
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="installation">
                        @include('comments::admin.partials.docs.installation')
                    </div>
                    <div class="tab-pane" id="configuration">
                        @include('comments::admin.partials.docs.configuration')
                    </div>
                    <div class="tab-pane" id="usage">
                        @include('comments::admin.partials.docs.usage')
                    </div>
                    <div class="tab-pane" id="events">
                        @include('comments::admin.partials.docs.events')
                    </div>
                    <div class="tab-pane" id="customization">
                        @include('comments::admin.partials.docs.customization')
                    </div>
                    <div class="tab-pane" id="debugging">
                        @include('comments::admin.partials.docs.debugging')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
