
<div style="display: flex;">
    <div style="width: 150px;margin-right: 10px;float:left;">
        <b>Email:</b> <br />  <br />
        <b>Email #2:</b> <br /> <br />
        <b>Phone number:</b> <br /> <br />
        <b>Facebook:</b> <br /> <br />
        <b>Twitter:</b> <br /> <br />
        <b>Other:</b> <br /> <br />
    </div>
    <div style="max-width: 400px;margin-right: 10px;float:left;">
        {{ $contactInfo ? ($contactInfo->primary_email ?: '') : '' }} <br /> <br />
        {{ $contactInfo ? ($contactInfo->secondary_email ?: '') : ''  }} <br /> <br />
        {{ $contactInfo ? ($contactInfo->phone_number ?: '') : ''  }} <br /> <br />
        {{ $contactInfo ? ($contactInfo->fb_link ?: '') : ''  }} <br /> <br />
        {{ $contactInfo ? ($contactInfo->twitter_link ?: '') : ''  }} <br /> <br />
        {{ $contactInfo ? ($contactInfo->other_link ?: '') : ''  }} <br /> <br />
    </div>
</div>