@extends('layouts._layout')

@section('index')

    {{--show alert when an item has been created successfully--}}
    @if(Session::get('status'))
        <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            {{Session::get('status')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                {{--                <span aria-hidden="true">&times;</span>--}}
            </button>
        </div>
    @endif

    {{--    tabs and tab contents--}}
    <div class="container tabs">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Active
                </button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Expired
                </button>
            </div>
        </nav>

        {{--        Active tab contents--}}
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                <!-- Button trigger modal for add item-->
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add item</button>

                <!-- Modal for add item-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <h5 class="modal-title" id="exampleModalLabel">Add item</h5>
                                {{--                                <button type="button" class="btn-close" data-bs-dismiss="modal"--}}
                                {{--                                        aria-label="Close"></button>--}}
                            </div>
                            <form action="/add" method="post">
                                @csrf
                                <div class="modal-body">
                                    <label for="name">Item Name</label>
                                    <input class="form-control" type="text" name="name"
                                           placeholder="e.g driver's license"/>

                                    <label for="category">Category</label>
                                    <select class="form-select" name="category" id="">
                                        <option value="">Select category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    <label for="expiry">Expiry Date</label>
                                    <input class="form-control" type="date" name="expiry"/>

                                    <label for="notification">Notification</label>
                                    <input class="form-control" type="number" name="notification"/> <span>Days before expiry</span>

                                    <input type="hidden" name="userId" value={{Auth::id()}} />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal end -->

                @if($data->count() == 0)
                    <p class="empty-state text-center">You have no item to be displayed. <br>Start adding items by
                        clicking the “Add item” button</p>
                @endif

            <!-- Display the item list -->
                @if($data->count() > 0)
                    <div class="container mt-4 item-list">
                        <div class="d-flex justify-content-between items-heading row">
                            <div class="col-3"><h6>Item Name</h6></div>
                            <div class="col-3 text-center"><h6>Expiry Date</h6></div>
                            <div class="col-3 text-center"><h6>Notification Date</h6></div>
                            <div class="col-3 text-center"><h6>Actions</h6></div>
                        </div>

                        @foreach($data as $items)
                            @if(date(now()) < $items->expiry_date)
                                <div class="d-flex justify-content-between item-single row">
                                    <div class="col-3 text-break"><h6>{{$items->name}}</h6></div>
                                    <div class="col-3 text-center"><h6>{{$items->expiry_date}}</h6></div>
                                    <div class="col-3 text-center"><h6>{{$items->notification_date}}</h6></div>
                                    <div class="col-3 text-center">
                                        <div>
                                            {{--                                    <a href="/edit/{{$items->id}}" data-bs-toggle="modal" data-bs-target="#editModal"><img class="edit-icon" src="{{asset('icons/pencil-fill.svg')}}" alt="edit"></a>--}}
                                            <img class="edit-icon" src="{{asset('icons/pencil-fill.svg')}}" alt="edit"
                                                 data-bs-toggle="modal" data-bs-target="#editModal"
                                                 onclick="itemModel({{$items->id}})">
                                            <input type="hidden" id="itemId" value={{$items->id}} />
                                            <img class="delete-icon" src="{{asset('icons/trash.svg')}}" alt="delete"
                                                 data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                 onclick="deleteModel({{$items->id}})">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
            @endif

            <!-- Modal for edit item-->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <h5 class="modal-title" id="editModalLabel">Edit item</h5>
                            </div>
                            <form action="/save" method="post">
                                @csrf
                                <div class="modal-body">
                                    <label for="name">Item Name</label>
                                    <input class="form-control" type="text" name="name" id="name"
                                           placeholder="e.g driver's license"/>

                                    <label for="category">Category</label>
                                    <select class="form-select" name="category" id="category">
                                        <option value="">Select category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>

                                    <label for="expiry">Expiry Date</label>
                                    <input class="form-control" type="date" name="expiry" id="date"/>

                                    <label for="notification">Notification</label>
                                    <input class="form-control" type="number" name="notification" id="notif"/> <span>Days before expiry</span>

                                    <input type="hidden" name="userId" value={{Auth::id()}} />
                                    <input type="hidden" name="item_Id" id="item_Id"/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal end -->


                <!-- Modal for delete item-->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header justify-content-center">
                                <h5 class="modal-title" id="editModalLabel">Delete item</h5>
                            </div>
                            <form action="/delete" method="get" id="deleteForm">
                                @csrf
                                <div class="modal-body">
                                    <p class="text-center">Do you want to delete this item?</p>
                                    <input type="hidden" name="id" id="deleteId"/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                    </button>
                                    <button type="submit" class="btn btn-primary">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal end -->

            </div>

            {{--            Expired tab contents--}}
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                <!-- Display the item list -->
                <div class="container mt-4 item-list">
                    <div class="d-flex justify-content-between items-heading row">
                        <div class="col-3"><h6>Item Name</h6></div>
                        <div class="col-3 text-center"><h6>Expiry Date</h6></div>
                        <div class="col-3 text-center"><h6>Notification Date</h6></div>
                        <div class="col-3 text-center"><h6>Actions</h6></div>
                    </div>

                    @foreach($data as $items)
                        @if(date(now()) > $items->expiry_date)
                            <div class="d-flex justify-content-between item-single row">
                                <div class="col-3 text-break"><h6>{{$items->name}}</h6></div>
                                <div class="col-3 text-center"><h6>{{$items->expiry_date}}</h6></div>
                                <div class="col-3 text-center"><h6>{{$items->notification_date}}</h6></div>
                                <div class="col-3 text-center">
                                    <div>
                                        <input type="hidden" id="itemId" value={{$items->id}} />
                                        <img class="delete-icon" src="{{asset('icons/trash.svg')}}" alt="delete"
                                             data-bs-toggle="modal" data-bs-target="#deleteModal"
                                             onclick="deleteModel({{$items->id}})">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <script>

        // Populate model when the edit icon is clicked
        function itemModel($id) {
            // let itemId = $('#itemId').val();
            $.ajax({
                type: "GET",
                url: "edit/" + $id,
                success: function (data) {
                    const items = JSON.parse(data);
                    console.log(items);
                    for (let x in items) {
                        $('#name').val(items[x].name);
                        $('#category').val(items[x].category_id);
                        $('#date').val(items[x].expiry_date);
                        $('#notif').val(items[x].notification);
                        $('#item_Id').val($id);
                    }
                }
            })
        }

        // Populate the delete modal when the delete icon is clicked
        function deleteModel($id) {
            $('#deleteId').val($id);
            $('#deleteForm').attr("action", "/delete/" + $id);
        }

    </script>

@endsection
