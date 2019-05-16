<div class="edit-prorfile">
    <div class="info-container">
        <form method="POST" action="/update-bio">
            {{ csrf_field() }}
            <div class="section-title-container">
                <h3>Tell us a bit about yourself:</h3>
            </div>

            <div class="edit-description-container">
                <header>
                    <textarea maxlength="141" cols="47" rows="3" placeholder="Add a description (141 characters or less)..." name="description">{{ Auth::user()->description }}</textarea>
                </header>
        
                <footer>
                    <button type="submit" class="save-button" >
                        <i class="far fa-save"></i>
                        Save
                    </button>
                </footer>
            </div>
        </form>
    </div>

    <div class="stances-container">
        <form method="POST" action="/add-stance">
            {{ csrf_field() }}
            
            <div class="section-title-container">
                <h3>Add stance:</h3>
            </div>

            <div class="create-stance-container">
                <header>
                    <input type="text" class="title" name="title" placeholder="Add a title..." required>
                </header>
                <div class="content-container">
                    <textarea maxlength="141" cols="47" rows="3" placeholder="Add a stance (141 characters or less)..." name="content" required></textarea>
                </div>
                
                <footer>
                    <button type="submit" class="save-button" >
                        <i class="far fa-save"></i>
                        Save
                    </button>
                </footer>
            </div>
        </form>
            
        <div class="section-title-container">
            <h3>Stances:</h3>
        </div>

        <div class="stances">
            @foreach (Auth::user()->politiciansInfo->stances as $stance)
                @include('..partials.text-card', [ 'stance' => $stance, 'classes' => 'editable' ])
            @endforeach
        </div>
    </div>
</div>