<div class="row my-1">
    <div class="col-4">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    {{ __('प्रयोगकर्ताको नाम') }}
                </span>
            </div>
            <select name="user_id" class="custom-select @error('user_id') is-invalid @enderror select2">
                <option value="">
                    {{ __('-प्रयोगकर्ताको नाम छान्नुहोस्-') }}
                </option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    {{ __('प्रदेश') }}
                </span>
            </div>
            <select name="province_id" class="custom-select @error('province_id') is-invalid @enderror select2">
                <option value="">
                    {{ __('-- प्रदेश छान्नुहोस् --') }}
                </option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">
                        प्रदेश नं {{ $province->EnglishName }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    {{ __('जिल्ला') }}
                </span>
            </div>
            <select name="district_id" class="custom-select @error('district_id') is-invalid @enderror select2">
                <option value="">
                    {{ __('-- जिल्ला छान्नुहोस् --') }}
                </option>
                @foreach ($districts as $district)
                    <option value="{{ $district->id }}">
                        {{ $district->NepaliName }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-3 mt-3">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    {{ __('गा.पा/ना.पा') }}
                </span>
            </div>
            <select name="district_id" class="custom-select @error('district_id') is-invalid @enderror select2">
                <option value="">
                    {{ __('-- गा.पा/ना.पा छान्नुहोस् --') }}
                </option>
                @foreach ($municipalities as $municipality)
                    <option value="{{ $municipality->id }}">
                        {{ $municipality->NepaliName }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-3 mt-3">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    {{ __('ग्रुप कोड') }}
                </span>
            </div>
            <select name="groupcode" class="custom-select @error('groupcode') is-invalid @enderror select2">
                <option value="">
                    {{ __('-- ग्रुप कोड छान्नुहोस् --') }}
                </option>
                @foreach ($groupcodes as  $groupcode)
                    <option value="{{ $groupcode }}">
                        {{ $groupcode}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-3 mt-3">
        <div class="input-group input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    {{ __('वार्ड नं.') }}
                </span>
            </div>
            <select name="ward_no" class="custom-select @error('ward_no') is-invalid @enderror select2">
                <option value="">
                    {{ __('--वार्ड नं छान्नुहोस् --') }}
                </option>
                @for ($i = 1; $i < 19; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-3 mt-3">
        <a class="btn btn-primary btn-sm text-white" wire:click="showReport()"><i class="fas fa-search px-2"></i>{{__('हेर्नुहोस्')}}</a>
    </div>
    <div class="col-md-12 mt-4" style="margin-bottom:-20px;">
        <p class="">{{ __('सर्वेक्षणको सुचिहरु') }}</p>
    </div>
</div>
