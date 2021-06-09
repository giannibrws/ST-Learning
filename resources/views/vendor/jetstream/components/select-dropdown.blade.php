<div>
    <select {!! $attributes->merge(['class' => 'w-full pl-3 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500'])!!}>
            <option name="{{$first}}" value="{{$first}}">{{$first}}</option>
        <option name="{{$second}}" value="{{$second}}">{{$second}}</option>
    </select>
</div>