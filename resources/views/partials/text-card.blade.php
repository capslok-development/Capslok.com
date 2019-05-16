
    <header>
        <div class="title-container">
            <div class="title" maxlength="141">{!! $stance->title !!}</div>
        </div>

        <div class="date">{{ $stance->getFormattedUpdateTime() }}</div>  
    </header>
    <div class="content-container" style="display: grid;">
        <div class="contenttext" maxlength="141">
            {!! $stance->content !!}
        </div>
    </div>