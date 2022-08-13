@extends('layout.dashborad')
@section('name','Edit Admin')
@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit : Admin</h4>
                    <form enctype="multipart/form-data" class="forms-sample" method="POST" action="{{route('admin.administration.update', ['administration'=>$adminUser->id])}}">
                        @csrf
                        @method("put")
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname" value="{{$adminUser->firstname}}" class="form-control" id="firstname" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" name="lastname" value="{{$adminUser->lastname}}" class="form-control" id="lastname" placeholder="Last Name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{$adminUser->email}}" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <label for="bio">Admin Bio</label>
                            <textarea class="form-control" name="bio" rows="10" style="height: 200px"> {{ $adminUser->bio }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role" placeholder="Select Role">
                                <option value='super' @if($adminUser->role === 'super') selected @endif>Super</option>
                                <option value='chat' @if($adminUser->role === 'chat') selected @endif>Chat</option>
                                <option value='verify' @if($adminUser->role === 'verify') selected @endif>Verify</option>
                                <option value='blog' @if($adminUser->role === 'blog') selected @endif>Blog</option>
                                <option value='product' @if($adminUser->role === 'product') selected @endif>Product</option>
                                <option value='content' @if($adminUser->role === 'content') selected @endif>Content</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                        <img src="{{route('images', ['for'=>'admin', 'image'=>$adminUser->img ?? 'default.png'])}}" height="300">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputUsername1">To Edit Image</label>
                            <input type="file" name="img" class="form-control file-upload-info" placeholder="Upload Image">
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-dark" >Cancel</button>
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
{{--    --}}{{-- <script>--}}
{{--        (function(){--}}

{{--            "use strict"--}}


{{--            // Plugin Constructor--}}
{{--            var TagsInput = function(opts){--}}
{{--                this.options = Object.assign(TagsInput.defaults , opts);--}}
{{--                this.init();--}}
{{--            }--}}

{{--            // Initialize the plugin--}}
{{--            TagsInput.prototype.init = function(opts){--}}
{{--                this.options = opts ? Object.assign(this.options, opts) : this.options;--}}

{{--                if(this.initialized)--}}
{{--                    this.destroy();--}}

{{--                if(!(this.orignal_input = document.getElementById(this.options.selector)) ){--}}
{{--                    console.error("tags-input couldn't find an element with the specified ID");--}}
{{--                    return this;--}}
{{--                }--}}

{{--                this.arr = [];--}}
{{--                this.wrapper = document.createElement('div');--}}
{{--                this.input = document.createElement('input');--}}
{{--                init(this);--}}
{{--                initEvents(this);--}}

{{--                this.initialized =  true;--}}
{{--                return this;--}}
{{--            }--}}

{{--            // Add Tags--}}
{{--            TagsInput.prototype.addTag = function(string){--}}

{{--                if(this.anyErrors(string))--}}
{{--                    return ;--}}

{{--                this.arr.push(string);--}}
{{--                var tagInput = this;--}}

{{--                var tag = document.createElement('span');--}}
{{--                tag.className = this.options.tagClass;--}}
{{--                tag.innerText = string;--}}

{{--                var closeIcon = document.createElement('a');--}}
{{--                closeIcon.innerHTML = '&times;';--}}

{{--                // delete the tag when icon is clicked--}}
{{--                closeIcon.addEventListener('click' , function(e){--}}
{{--                    e.preventDefault();--}}
{{--                    var tag = this.parentNode;--}}

{{--                    for(var i =0 ;i < tagInput.wrapper.childNodes.length ; i++){--}}
{{--                        if(tagInput.wrapper.childNodes[i] == tag)--}}
{{--                            tagInput.deleteTag(tag , i);--}}
{{--                    }--}}
{{--                })--}}


{{--                tag.appendChild(closeIcon);--}}
{{--                this.wrapper.insertBefore(tag , this.input);--}}
{{--                this.orignal_input.value = this.arr.join(',');--}}

{{--                return this;--}}
{{--            }--}}

{{--            // Delete Tags--}}
{{--            TagsInput.prototype.deleteTag = function(tag , i){--}}
{{--                tag.remove();--}}
{{--                this.arr.splice( i , 1);--}}
{{--                this.orignal_input.value =  this.arr.join(',');--}}
{{--                return this;--}}
{{--            }--}}

{{--            // Make sure input string have no error with the plugin--}}
{{--            TagsInput.prototype.anyErrors = function(string){--}}
{{--                if( this.options.max != null && this.arr.length >= this.options.max ){--}}
{{--                    console.log('max tags limit reached');--}}
{{--                    return true;--}}
{{--                }--}}

{{--                if(!this.options.duplicate && this.arr.indexOf(string) != -1 ){--}}
{{--                    console.log('duplicate found " '+string+' " ')--}}
{{--                    return true;--}}
{{--                }--}}

{{--                return false;--}}
{{--            }--}}

{{--            // Add tags programmatically--}}
{{--            TagsInput.prototype.addData = function(array){--}}
{{--                var plugin = this;--}}

{{--                array.forEach(function(string){--}}
{{--                    plugin.addTag(string);--}}
{{--                })--}}
{{--                return this;--}}
{{--            }--}}

{{--            // Get the Input String--}}
{{--            TagsInput.prototype.getInputString = function(){--}}
{{--                return this.arr.join(',');--}}
{{--            }--}}


{{--            // destroy the plugin--}}
{{--            TagsInput.prototype.destroy = function(){--}}
{{--                this.orignal_input.removeAttribute('hidden');--}}

{{--                delete this.orignal_input;--}}
{{--                var self = this;--}}

{{--                Object.keys(this).forEach(function(key){--}}
{{--                    if(self[key] instanceof HTMLElement)--}}
{{--                        self[key].remove();--}}

{{--                    if(key != 'options')--}}
{{--                        delete self[key];--}}
{{--                });--}}

{{--                this.initialized = false;--}}
{{--            }--}}

{{--            // Private function to initialize the tag input plugin--}}
{{--            function init(tags){--}}
{{--                tags.wrapper.append(tags.input);--}}
{{--                tags.wrapper.classList.add(tags.options.wrapperClass);--}}
{{--                tags.orignal_input.setAttribute('hidden' , 'true');--}}
{{--                tags.orignal_input.parentNode.insertBefore(tags.wrapper , tags.orignal_input);--}}
{{--            }--}}

{{--            // initialize the Events--}}
{{--            function initEvents(tags){--}}
{{--                tags.wrapper.addEventListener('click' ,function(){--}}
{{--                    tags.input.focus();--}}
{{--                });--}}


{{--                tags.input.addEventListener('keydown' , function(e){--}}
{{--                    var str = tags.input.value.trim();--}}

{{--                    if( !!(~[9 , 13 , 188].indexOf( e.keyCode ))  )--}}
{{--                    {--}}
{{--                        e.preventDefault();--}}
{{--                        tags.input.value = "";--}}
{{--                        if(str != "")--}}
{{--                            tags.addTag(str);--}}
{{--                    }--}}

{{--                });--}}
{{--            }--}}


{{--            // Set All the Default Values--}}
{{--            TagsInput.defaults = {--}}
{{--                selector : '',--}}
{{--                wrapperClass : 'tags-input-wrapper',--}}
{{--                tagClass : 'tag',--}}
{{--                max : null,--}}
{{--                duplicate: false--}}
{{--            }--}}

{{--            window.TagsInput = TagsInput;--}}

{{--        })();--}}

{{--        var tagInput1 = new TagsInput({--}}
{{--            selector: 'tag-input1',--}}
{{--            duplicate : false,--}}
{{--            max : 10--}}
{{--        });--}}

{{--        var array_tags = @json($arr_tags); //JSON.parse('{{ json_encode($arr_tags) }}');--}}
{{--        tagInput1.addData(array_tags)--}}

{{--    </script> --}}
@endsection
