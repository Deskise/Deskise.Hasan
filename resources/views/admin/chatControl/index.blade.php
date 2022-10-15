@extends('layout.dashborad')
@section('name','Chat Control')

@section('btn')
@endsection

@section('css')

@endsection

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card" >
            <div class="card-body">

                    <form method="POST" action="{{ route('admin.chatControl.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="m-2 p-2">
                                <div class="row p-2 m-2">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <p class="form-label fs-5 pb-2 ">Forbidden Words:  </p>
                                                <input type="text" name="blocked_keywords" id="tag-input1" class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <p class="form-label fs-5">General Chat Settings:  </p>
                                            <div class="form-group m-1 ps-2">
                                                <div class="form-check color">
                                                    <input class="form-check-input" type="checkbox" name="block_phones" id="block_phones"  @if ($chatConf->get('0')->block_phones) checked  @endif>
                                                    <label class="form-check-label fs-6 " for="block_phones" style="color: #ee6b0d">Block Phone Numbers</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="block_email" id="block_email" @if ($chatConf->get('0')->block_email) checked @endif/>
                                                    <label class="form-check-label fs-6" for="block_email" style="color: #ee6b0d">Block Emails</label>
                                                </div>

                                            </div>
                                        </div>
                                </div>

                                <div class="row p-2 m-2">
                                    <div class="form-group text-center align-self-center h-100">
                                        <button type="submit" class="btn btn-primary btn-flat btn-lg" >Save Changes</button>
                                    </div>
                                </div>
                        </div>
                </form>
            </div>

        </div>
    </div>

    <style>
        .tags-input-wrapper{
            background: transparent;
            padding: 10px;
            border-radius: 5px;
            max-width: 400px;
            max-height: 1000px;
            height: 450px;
            border: 1px solid #ee6b0d
        }
        .tags-input-wrapper input{
            border: none;
            background: transparent;
            outline: none;
            width: 200px;
            margin-left: 8px;
            color: #fff;
        }
        .tags-input-wrapper .tag{
            display: inline-block;
            background-color: #f50404;
            color: black;
            border-radius: 30px;
            padding: 0px 3px 0px 7px;
            margin-right: 5px;
            margin-bottom:5px;
            box-shadow: 0 5px 15px -2px rgba(231, 16, 16, 0.76)
        }
        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>
@endsection

@section('js')


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
            max : 5000
        });

        var array_tags = @json($shitWords); //JSON.parse('{{ json_encode($shitWords) }}');--}}
        tagInput1.addData(array_tags)

    </script>
@endsection


