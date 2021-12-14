<div class="row">
    <div class="col-6 mb-2">
        आज मिति {{ Nepali($meeting->dateBs) }} यस कार्यपालिका समितिको {{ Nepali($meetingCount) }} औ बैठक
        {{ $meeting->subject }} मा समितका
    </div>
    <div class="col-6 mb-2">
        <select wire:model="post_id" class="form-control-sm form-control">
            <option value="">{{ __('--पद छान्नुहोस्--') }}</option>
            @foreach ($posts as $post)
                <option value="{{ $post->id }}">{{ $post->name }}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="post_id" value="{{$post_id}}">
    <input type="hidden" name="survey_id" value="{{ $memberName === null ? '': $memberName->surveyData->id}}">
    <div class="col-6 mb-3">
        अध्यक्षतामा {{ $memberName === null ? '...........' : $memberName->surveyData->name}} बसि निम्न प्रस्तावहरु उपर छलफल गरी निम्न निर्णयमा पुगि समाप्त गरियो ।
    </div>
</div>
