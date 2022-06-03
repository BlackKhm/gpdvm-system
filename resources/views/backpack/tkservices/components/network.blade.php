@extends('backpack.layouts.app')

@section('content')
    @include('backpack.tkservices.partials.head')

    @include('backpack.tkservices.partials.navbar')

    <div class="bg-white">
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-6">
                    <h4 class="font-weight-bold">សម្រាប់ព័ត៌មានបន្ថែម</h4>
                    <div class="mt-2">
                        <p>
                            អង្គការ​ថែទាំ​សុខភាព​គ្រួសារ​កម្ពុជា
                            ជា​អង្គការ​ឈានមុខ​គេ​មួយ​ក្នុងការ​ផ្តល់នូវ​ការធ្វើផែនការ​គ្រួសារ​ដែលមានគុណភាព
                            និង​សេវា​សុខភាព​ផ្លូវភេទ​និង​សុខភាព​បន្ត​ពូជ​នៅក្នុង​ប្រទេស​កម្ពុជា​។
                            ការងារ​របស់​យើង​គឺ​ដើម្បី​ដោះស្រាយ​តម្រូវការ​ខ្ពស់​នៃ​សេវា​ពន្យារកំណើត ជំងឺឆ្លង
                            តាមផ្លូវ​បន្ត​ពូជ​ក្នុងចំណោម​ស្ត្រី​និង​បុរស ការថែទាំ​សុខភាព​ស្ត្រី​មាន​ផ្ទៃពោះ សុខភាព​កុមារ
                            ជំងឺរបេង ជំងឺអេដស៍ ជំងឺឆ្លង​និង​មិន​ឆ្លង​ដទៃទៀត ។​ល​។ ក្នុង​ឆ្នាំ​​ ២០១៥
                            យើង​បាន​អនុវត្ត​គម្រោង​កម្មវិធី​របស់​យើង​នៅក្នុង ១៤​ខេត្ត​ក្រុង​មានដូចជា​៖ កំពង់ចាម ត្បូងឃ្មុំ
                            បាត់ដំបង កំពង់ស្ពឺ ព្រះសីហនុ កោះកុង សៀមរាប ស្វាយរៀង មណ្ឌលគិរី តាកែវ កំពង់ឆ្នាំង កំពង់ធំ កំពត​
                            និង​រាជធានី​ភ្នំពេញ​។​
                        </p>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12 ">
                            <i style="color: cadetblue;" class="bi bi-check2-circle"></i> ទីស្នាក់ការកណ្ដាលផ្ទះលេខ ០៥ ផ្លូវលេខ ៦០០ សង្កាត់បឹងកក់២ ខណ្ឌទួលគោក ក្រុងភ្នំពេញ
                        </div>
                        <div class="col-md-12 mt-2">
                            <i style="color: cadetblue;" class="bi bi-check2-circle"></i> (៨៥៥ ២៣) ៨៨៣ ០២៧ (៨៥៥ ២៣) ៨៨១ ៧៤៧
                        </div>
                        <div class="col-md-12 mt-2">
                            <i style="color: cadetblue;" class="bi bi-check2-circle"></i> info@rhac.org.kh
                        </div>
                        <div class="col-md-12 mt-2">
                            <i style="color: cadetblue;" class="bi bi-check2-circle"></i> www.rhac.org.kh
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order-md-1">
                    <h4 class="mb-3 font-weight-bold">ភ្ជាប់ទំនាក់ទំនងជាមួយយើង</h4>
                    <form class="needs-validation" novalidate="">
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="firstName">First name</label>
                          <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                          <div class="invalid-feedback">
                            Valid first name is required.
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="lastName">Last name</label>
                          <input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
                          <div class="invalid-feedback">
                            Valid last name is required.
                          </div>
                        </div>
                      </div>
          
                      <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                          </div>
                          <input type="text" class="form-control" id="username" placeholder="Username" required="">
                          <div class="invalid-feedback" style="width: 100%;">
                            Your username is required.
                          </div>
                        </div>
                      </div>
          
                      <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                          Please enter a valid email address for shipping updates.
                        </div>
                      </div>
          
                      <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                        <div class="invalid-feedback">
                          Please enter your shipping address.
                        </div>
                      </div>
          
                      <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                      </div>
          
                      <button class="btn btn-primary btn-lg btn-block" type="submit">Submit</button>
                    </form>
                  </div>
            </div>
        </div>
    </div>
    <br>

    @include('backpack.tkservices.partials.footer')

@endsection
