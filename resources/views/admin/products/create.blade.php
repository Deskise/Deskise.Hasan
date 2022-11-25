@extends('layout.dashborad')
@section('name','Add New Product')
@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body col-12 col-lg-7 pe-3 pe-lg-5">
                    <h4 class="card-title pb-2">Add New Product</h4>
                    <form enctype="multipart/form-data" class="forms-sample" method="post" action="{{ route('admin.products.store') }}">
                        @csrf
                        <div class="form-group" title="Basic Details">
                            <label class="fs-6">Basic Details</label>
                            <div class="form-group">
                                <select name="businessModel" id="businessModel" class="form-control" placeholder="Select Business Model">
                                    <option disabled selected value>Select Business Model</option>
                                    <option value='2'>else</option>
                                    <option value='5'>Ahmed</option>
                                    <option value='10'>Something</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="url" name="Eveniet" class="form-control" id="Eveniet" placeholder="Add Url" title="lorem ipsum">
                            </div>
                        </div>

                        <div class="form-group" title="Lorem ipsum">
                            <label class="fs-6">Lorem ipsum</label>
                                <div class="form-group">
                                    <input type="number" name="Ipsum ea." min="0" max="400" step="0.5" class="form-control" id="Ipsum ea." placeholder="Average monthly traffic">
                                </div>
                                <div class="form-group">
                                    <input type="date" name="Vel." class="form-control" id="Eveniet" placeholder="When did the business start" title="When did the business start">
                                </div>
                                <div class="form-group">
                                    <input type="date" name="Iste" class="form-control" id="Iste" placeholder="When did the business start making money" title="When did the business start making money">
                                </div>
                        </div>

                        <div class="form-group" title="Do You Currently Have Either Google Analytics Or Clicky Installed?">
                            <label class="fs-6">Do You Currently Have Either Google Analytics Or Clicky Installed?</label>
                            <div class="form-group form-check-inline d-flex">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                </div>
                                <div div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                </div>
                            </div>

                            <div class="form-group">
                            <table class="table table-bordered align-center">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        @for ($i=1;$i<=12;$i++)
                                            <th>{{ $i }}</th>
                                        @endfor

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">months</th>
                                        @for ($i=1;$i<=12;$i++)
                                            <td contenteditable="true"></td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <th scope="row">profit</th>
                                        @for ($i=1;$i<=12;$i++)
                                            <td contenteditable="true"></td>
                                        @endfor
                                    </tr>
                                    <tr>
                                        <th scope="row">visits</th>
                                        @for ($i=1;$i<=12;$i++)
                                            <td contenteditable="true"></td>
                                        @endfor
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>

                        <div class="form-group" title="Business Assets Included">
                            <label class="fs-6">Business Assets Included</label>
                            <input class="form-control" type="url" name="links" id="links" placeholder="links">
                        </div>

                        <div class="form-group" title="Write a full description of the project">
                            <textarea class="form-control" name="Delectus." id="Delectus." cols="30" rows="20" placeholder="Write a full description of the project" style="min-height: 250px;" ></textarea>
                        </div>

                        <div class="form-group" title="Briefly Tell Us About Your Business">
                            <textarea class="form-control" name="Ex." id="Ex." cols="30" rows="20" placeholder="Briefly Tell Us About Your Business" style="min-height: 250px;" ></textarea>
                        </div>

                        <div class="form-group" title="Add Photos And Media">
                            <label class="fs-6">Add Photos And Media</label>
                            <input type="file" name="Error." class="form-control file-upload-info" placeholder="Add Photos And Media">
                        </div>

                        <div class="form-group" title="Price">
                            <div class="form-grou">
                                <label class="fs-6">Price</label>
                                <input type="number" name="Velit et." min="0" max="400" step="0.5" class="form-control" placeholder="Price">
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Iure." id="Iure." placeholder="Automatic Expiration Setting And Automatic Price Determination From The Expiration Date" style="cursor: pointer;">
                                <label class="form-check-label" for="Iure." style="cursor: pointer;">Automatic Expiration Setting And Automatic Price Determination From The Expiration Date</label>
                            </div>
                        </div>

                        <div class="form-group" title="Site Service">
                            <label class="fs-6">Site Service</label>
                            <input type="number" name="Labore in." min="0" max="400" step="0.5" class="form-control" placeholder="Price">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="Tenetur." id="Tenetur." placeholder="Automatic Expiration Setting And Automatic Price Determination From The Expiration Date" style="cursor: pointer;">
                                <label class="form-check-label" for="Tenetur." style="cursor: pointer;">Automatic Expiration Setting And Automatic Price Determination From The Expiration Date</label>
                            </div>
                        </div>


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
