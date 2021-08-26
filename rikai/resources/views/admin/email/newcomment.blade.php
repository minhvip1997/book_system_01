<h1>{{__('message.NewComment')}}</h1>
<h2>{{$comment->user()->value('name')}} {{__('message.comment_by_you')}}</h2>
<h2>{{__('message.Content')}}</h2>
<div>
    <h3>{{__('message.Body')}}</h3>
    <p>{{$comment->body}}</p>
</div>