 @extends('client.layouts.master')
 @section('content')
 <div class="review border-default universal-padding mt-30">
     <h2 class="review-title mb-30">You're reviewing: <br><span>Go-Get'r Pushup Grips</span></h2>
     <p class="review-mini-title">your rating</p>
     <ul class="review-list">
         <!-- Single Review List Start -->
         <li>
             <span>Quality</span>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o"></i>
             <i class="fa fa-star-o"></i>
         </li>
         <!-- Single Review List End -->
         <!-- Single Review List Start -->
         <li>
             <span>price</span>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o"></i>
             <i class="fa fa-star-o"></i>
             <i class="fa fa-star-o"></i>
         </li>
         <!-- Single Review List End -->
         <!-- Single Review List Start -->
         <li>
             <span>value</span>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star"></i>
             <i class="fa fa-star-o"></i>
         </li>
         <!-- Single Review List End -->
     </ul>
     <!-- Reviews Field Start -->
     <div class="riview-field mt-40">
         <form autocomplete="off" action="#">
             <div class="form-group">
                 <label class="req" for="sure-name">Nickname</label>
                 <input type="text" class="form-control" id="sure-name" required="required">
             </div>
             <div class="form-group">
                 <label class="req" for="subject">Summary</label>
                 <input type="text" class="form-control" id="subject" required="required">
             </div>
             <div class="form-group">
                 <label class="req" for="comments">Review</label>
                 <textarea class="form-control" rows="5" id="comments" required="required"></textarea>
             </div>
             <button type="submit" class="btn-submit">Submit Review</button>
         </form>
     </div>
     <!-- Reviews Field Start -->
 </div>
 @endsection