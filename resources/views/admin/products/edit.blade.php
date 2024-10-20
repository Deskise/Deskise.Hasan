@extends('layout.dashborad')
@section('name','Edit Product')
@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body col-12 col-lg-7 pe-3 pe-lg-5">
                    <h4 class="card-title pb-2">Edit Product</h4>
                    <form enctype="multipart/form-data" class="forms-sample" method="post" action="{{ route('admin.products.update', $product) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="is_lifetime" id="is_lifetime"
                                  @if (old('is_lifetime', $product->is_lifetime)) checked @endif
                                  onchange="let el = $('#lifetime_date'); if (!this.checked) { el.show() } else { el.hide() }"
                                  />
                                <label class="form-check-label" for="is_lifetime">is lifetime?</label>
                            </div>
                            <div id="lifetime_date">
                                <label for="until">until</label>
                                <input type="date" id="until" name="until" class="form-control" value="{{ $product->until ? $product->until->format('Y-m-d') : '' }}"/>
                            </div>
                        </div>

                        @foreach($cat->data as $datum)
                            @foreach($datum['divs'] as $div)
                                <div class="form-group" title="{{ $div['title'] }}">
                                    <label class="fs-6">{{ $div['title'] }}</label>
                                        <div class="form-group">
                                            @foreach($div['fields'] as $field)
                                             @php
                                                $fieldName = $field['name'];
                                                $fieldType = $field['type'];
                                                $fieldValue = $product->$fieldName ?? null;
                                            @endphp
                                                @switch($field['type'])
                                                    @case('drop_list')
                                                        <select name="{{$field['name']}}" class="form-control mb-1">
                                                            <option disabled selected value>{{ $field['placeholder'] }}</option>
                                                            <option value="{{ $fieldValue }}">{{ $fieldValue }}</option>
                                                            @foreach($field['data'] as $key => $val)
                                                                <option value='{{ $key }}'> {{ $val }} </option>
                                                            @endforeach
                                                        </select>
                                                    @break

                                                    @case('subcategory')
                                                        <select name="{{$field['name']}}" id="businessModel" class="form-control mb-1" >
                                                            <option disabled selected value>Select Subcategory</option>
                                                            @foreach($cat->subcategories as $sub)
                                                                <option value='{{ $sub->id }}'> {{ $sub->name_en }} </option>
                                                            @endforeach
                                                        </select>
                                                        @break

                                                    @case('text')
                                                        <input type="text" name="{{ $field['name'] }}" class="form-control mb-1" placeholder="{{ $field['placeholder'] }}" title="{{ $field['hint']??'' }}"  value="{{ $fieldValue }}">
                                                    @break

                                                    @case('url')
                                                        <input type="url" name="{{ $field['name'] }}" class="form-control mb-1" placeholder="{{ $field['placeholder'] }}" title="{{ $field['hint']??'' }}" value="{{ $fieldValue }}">
                                                    @break

                                                    @case('number')
                                                        <input type="number" name="{{ $field['name'] }}" min="{{ $field['data']['min']??'' }}" max="{{ $field['data']['max']??'' }}" class="form-control mb-1" placeholder="{{ $field['placeholder'] }}" value="{{ $fieldValue }}">
                                                        @break

                                                    @case('date')
                                                        <input type="date" name="{{ $field['name'] }}" class="form-control mb-1" placeholder="{{ $field['placeholder'] }}" title="{{ $field['placeholder'] }}" value="{{ $fieldValue ? date('dd-mm-yyyy', strtotime($fieldValue)) : '' }}">
                                                        @break

                                                    @case('checkbox')
                                                        <div class="form-check mb-1">
                                                            <input type="checkbox" class="form-check-input" name="{{ $field['name'] }}" id="{{ $field['name'] }}" placeholder="{{ $field['placeholder'] }}" style="cursor: pointer;" value="{{ $fieldValue }}">
                                                            <label class="form-check-label" for="{{ $field['name'] }}" style="cursor: pointer;">{{ $field['placeholder'] }}</label>
                                                        </div>
                                                        @break

                                                    @case('y_n')
                                                        <div class="form-group mb-1">
                                                            <label>{{ $field['placeholder'] }}</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="{{ $field['name'] }}" id="{{ $field['name'] }}_y" value="yes">
                                                                <label class="form-check-label" for="{{ $field['name'] }}_y">Yes</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="{{ $field['name'] }}" id="{{ $field['name'] }}_n" value="no">
                                                                <label class="form-check-label" for="{{ $field['name'] }}_n" >No</label>
                                                            </div>
                                                        </div>
                                                        @break
                                                    @case('table')
                                                        <table class="table table-bordered align-center mb-1">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">{{ array_shift($field['data']['rows']) }}</th>
                                                                @foreach ($cols=$field['data']['cols'] as $col)
                                                                    <th>{{ $col }}</th>
                                                                @endforeach

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                @foreach ($field['data']['rows'] as $row)
                                                                <th scope="row">{{ $row }}</th>
                                                                    @foreach($cols as $col)
                                                                        <td style="position:relative;">
                                                                            <input type="text" name="{{ $field['name'] }}[{{$row}}][{{ $col }}]" style="height: 100%;width: 100%;position: absolute;top: 0;left: 0;background: transparent;border: 0;" class="form-control" />
                                                                        </td>
                                                                    @endforeach
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                        @break

                                                    @case('links')
                                                        @foreach($links as $link)
                                                        @php
                                                            $socialLink = $social->where('social_id', $link->id)->first();
                                                            $linkValue = $socialLink ? $socialLink->link : '';
                                                        @endphp
                                                            <input class="form-control mb-1" type="url" name="{{ $field['name'] }}[{{ $link->id }}]" id="links" placeholder="{{ $link->name_en }} Link" value="{{ $linkValue }}" />
                                                        @endforeach
                                                        @break

                                                    @case('textarea')
                                                        <textarea class="form-control mb-1" name="{{ $field['name'] }}" cols="30" rows="20" placeholder="{{ $field['placeholder'] }}" style="min-height: 250px;" value="{{ $fieldValue }}">{{ $fieldValue }}</textarea>
                                                        @break

                                                    {{-- @case('assets')
                                                        <input type="file" name="assets[]" class="form-control file-upload-info mb-1" placeholder="Add Photos And Media" multiple />
                                                        @break --}}
                                                    @case('file')
                                                        <input type="file" name="{{ $field['name'] }}" class="form-control file-upload-info mb-1" title="{{ $field['placeholder']??'' }}" multiple value="{{ $fieldValue }}" />
                                                        @break
                                                @endswitch
                                            @endforeach

                                    </div>
                                </div>
                            @endforeach
                        @endforeach


                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a class="btn btn-dark" href="{{route('admin.products.index')}}">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .tags-input-wrapper{
            background: transparent;
            padding: 10px;
            border-radius: 4px;
            max-width: 400px;
            border: 1px solid #ccc
        }
        .tags-input-wrapper input{
            border: none;
            background: transparent;
            outline: none;
            width: 140px;
            margin-left: 8px;
            color: #fff;
        }
        .tags-input-wrapper .tag{
            display: inline-block;
            background-color: #fa0e7e;
            color: white;
            border-radius: 40px;
            padding: 0px 3px 0px 7px;
            margin-right: 5px;
            margin-bottom:5px;
            box-shadow: 0 5px 15px -2px rgba(250 , 14 , 126 , .7)
        }
        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>
    <script>
        (function(){

            "use strict"


            // Plugin Constructor
            var TagsInput = function(opts){
                this.options = Object.assign(TagsInput.defaults , opts);
                this.init();
            }

            // Initialize the plugin
            TagsInput.prototype.init = function(opts){
                this.options = opts ? Object.assign(this.options, opts) : this.options;

                if(this.initialized)
                    this.destroy();

                if(!(this.orignal_input = document.getElementById(this.options.selector)) ){
                    console.error("tags-input couldn't find an element with the specified ID");
                    return this;
                }

                this.arr = [];
                this.wrapper = document.createElement('div');
                this.input = document.createElement('input');
                init(this);
                initEvents(this);

                this.initialized =  true;
                return this;
            }

            // Add Tags
            TagsInput.prototype.addTag = function(string){

                if(this.anyErrors(string))
                    return ;

                this.arr.push(string);
                var tagInput = this;

                var tag = document.createElement('span');
                tag.className = this.options.tagClass;
                tag.innerText = string;

                var closeIcon = document.createElement('a');
                closeIcon.innerHTML = '&times;';

                // delete the tag when icon is clicked
                closeIcon.addEventListener('click' , function(e){
                    e.preventDefault();
                    var tag = this.parentNode;

                    for(var i =0 ;i < tagInput.wrapper.childNodes.length ; i++){
                        if(tagInput.wrapper.childNodes[i] == tag)
                            tagInput.deleteTag(tag , i);
                    }
                })


                tag.appendChild(closeIcon);
                this.wrapper.insertBefore(tag , this.input);
                this.orignal_input.value = this.arr.join(',');

                return this;
            }

            // Delete Tags
            TagsInput.prototype.deleteTag = function(tag , i){
                tag.remove();
                this.arr.splice( i , 1);
                this.orignal_input.value =  this.arr.join(',');
                return this;
            }

            // Make sure input string have no error with the plugin
            TagsInput.prototype.anyErrors = function(string){
                if( this.options.max != null && this.arr.length >= this.options.max ){
                    console.log('max tags limit reached');
                    return true;
                }

                if(!this.options.duplicate && this.arr.indexOf(string) != -1 ){
                    console.log('duplicate found " '+string+' " ')
                    return true;
                }

                return false;
            }

            // Add tags programmatically
            TagsInput.prototype.addData = function(array){
                var plugin = this;

                array.forEach(function(string){
                    plugin.addTag(string);
                })
                return this;
            }

            // Get the Input String
            TagsInput.prototype.getInputString = function(){
                return this.arr.join(',');
            }


            // destroy the plugin
            TagsInput.prototype.destroy = function(){
                this.orignal_input.removeAttribute('hidden');

                delete this.orignal_input;
                var self = this;

                Object.keys(this).forEach(function(key){
                    if(self[key] instanceof HTMLElement)
                        self[key].remove();

                    if(key != 'options')
                        delete self[key];
                });

                this.initialized = false;
            }

            // Private function to initialize the tag input plugin
            function init(tags){
                tags.wrapper.append(tags.input);
                tags.wrapper.classList.add(tags.options.wrapperClass);
                tags.orignal_input.setAttribute('hidden' , 'true');
                tags.orignal_input.parentNode.insertBefore(tags.wrapper , tags.orignal_input);
            }

            // initialize the Events
            function initEvents(tags){
                tags.wrapper.addEventListener('click' ,function(){
                    tags.input.focus();
                });


                tags.input.addEventListener('keydown' , function(e){
                    var str = tags.input.value.trim();

                    if( !!(~[9 , 13 , 188].indexOf( e.keyCode ))  )
                    {
                        e.preventDefault();
                        tags.input.value = "";
                        if(str != "")
                            tags.addTag(str);
                    }

                });
            }


            // Set All the Default Values
            TagsInput.defaults = {
                selector : '',
                wrapperClass : 'tags-input-wrapper',
                tagClass : 'tag',
                max : null,
                duplicate: false
            }

            window.TagsInput = TagsInput;

        })();

        var tagInput1 = new TagsInput({
            selector: 'tag-input1',
            duplicate : false,
            max : 10
        });

        tagInput1.addData([])

    </script>

@endsection
