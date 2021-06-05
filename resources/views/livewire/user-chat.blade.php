<div class="">
   <x-jet-button wire:click.prevent="displayUserChat">Show messages:</x-jet-button>
    @if($is_visible)
        <div class="" >
        @foreach($messages as $message)
          <p>{{$message->body}}</p>
        </div>
        @endforeach
    @endif
</div>