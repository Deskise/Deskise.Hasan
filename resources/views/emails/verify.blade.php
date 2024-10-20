@component('mail::message')
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae inventore ab quia sequi molestias veritatis! Totam enim atque deleniti reiciendis.</p>
  <br>
  <p>copy the verification code and paste it in specified field in deskise.com</p>
  <br>

  <div class="verf">
    <p>your verification code is: <span class="code">{{ $verification->verifyCode }}</span></p>
  </div>
  <br>

Thanks,<br>
<p class="brand-name">{{ config('app.name') }}</p>
@endcomponent

<style>
  .code{
    font-weight: bold !important;
  }
  .brand-name{
    font-weight: bold !important;
    color: #3eadb7 !important;
  }
  .verf{
    display: flex !important; 
    align-items: center !important;
    justify-content: center !important;
    border: 1px solid #eaeaea !important;
    border-radius: 10px !important;
  }
  .verf > p {
    margin-top: 15px
  }
</style>