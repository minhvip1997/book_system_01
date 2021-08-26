<h1>{{__('message.NewReview')}}</h1>
<h2>{{$review->user()->value('name')}} {{__('message.review_by_you')}}</h2>
<h2>{{__('message.Content')}}</h2>
<div>
    <h3>{{__('message.Title')}}</h3>
    <p>{{$review->title}}</p>
</div>
<div>
    <h3>{{__('message.Body')}}</h3>
    <p>{{$review->body}}</p>
</div>
<div>
    <h3>{{__('message.rates')}}</h3>
    <p>{{$review->rate}}</p>
</div>