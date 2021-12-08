@extends('layouts.main')
@section('title', 'समिति गठन')
@section('main_content')
    <div class="card text-sm ">
        <div class="card-header my-2">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('समिति गठनको सुचिहरु') }}</p>
                </div>
                <div class="
                        col-md-6 text-right">
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body" id="app">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('क्र.स.') }}</th>
                        <th class="text-center">{{ __('समिति गठन') }}</th>
                        <th class="text-center">{{ __('समितिका पदाधकारी') }}</th>
                        <th class="text-center">{{ __('सम्पदान कार्य') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($groupcodes as $key => $groupcode)
                        <tr>
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ Nepali($groupcode) }}
                            </td>
                            <td class="text-center">
                                <a v-on:click="showSmaiti('{{ $groupcode }}')" class="btn btn-warning btn-sm mb-0"
                                    data-toggle="modal" data-target="#modal-lg">
                                    {{ Nepali($post_counts[$groupcode]) . ' ' . __(' जना पदाधकारी') }}</a>
                            </td>
                            <td class="text-center"><a href="{{ route('committee-formed.edit', $groupcode) }}"
                                    class="btn-sm btn-success"><i class="fas fa-edit px-1"></i> {{ __('सच्याउने') }}</a>
                            </td>
                        </tr>
                    @endforeach
            </table>

            {{-- modal for adding committee_post status --}}
            <div class="modal fade text-sm" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="">{{ __('समिति गठन थप्नुहोस') }}</h5>
                            <button type=" button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('क्र. स.') }}</th>
                                        <th>{{ __('नाम') }}</th>
                                        <th>{{ __('pad') }}</th>
                                        <th>{{ __('मोवाइल नं.') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item,index) in groupMembers">
                                        <td class="text-center">@{{ index + 1 }}</td>
                                        <td class="text-center">@{{ item.survey_data.name }}</td>
                                        <td class="text-center">{{ __('सदस्य') }}</td>
                                        <td class="text-center">@{{ item.survey_data.contact_no}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            {{-- end of modal for adding committee_post status --}}

        </div>
        <!-- /.card-body -->
    </div>

@endsection

@section('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
    </script>
    <script src="{{ asset('vue/bundle.js') }}"></script>
    <script>
        new Vue({
            el: "#app",
            data: {
                groupMembers: []
            },
            methods: {
                showSmaiti: function(groupCode) {
                    let vm = this;
                    axios.get("{{ route('api.groupcode') }}", {
                            params: {
                                groupCode: groupCode
                            }
                        })
                        .then(function(response) {
                            console.log(response);
                            vm.groupMembers = response.data.groupMembers;
                            console.log(vm.groupMembers);
                        })
                        .catch(function(error) {
                            console.log(error);
                            alert("Some Problem Occured");
                        });
                }
            },
            mounted() {}
        })
    </script>
@endsection
