<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional CV</title>
    <style>
        .section-content {
            display: flex;
            flex-direction: column; 
        }

        .certificate-item {
            display: flex;
            align-items: center; 
            margin-bottom: 20px; 
        }

        .certificate-details {
            flex: 1;
            margin-right: 15px;
        }

        .user-image img {
            max-width: 100px; 
            border-radius: 50%; 
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3 {
            color: #2c3e50;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.2em;
            color: #7f8c8d;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 1.5em;
            color: #2980b9;
            border-bottom: 2px solid #3498db;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        .section-content {
            padding-left: 10px;
        }

        .experience, .education, .skills, .languages {
            margin-bottom: 20px;
        }

        .experience h3, .education h3, .skills h3, .languages h3 {
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .experience p, .education p {
            margin-bottom: 5px;
            color: #7f8c8d;
        }

        .skills-list, .languages-list {
            list-style: none;
            padding-left: 0;
        }

        .skills-list li, .languages-list li {
            background-color: #ecf0f1;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .skills-list li strong, .languages-list li strong {
            color: #2c3e50;
        }

        .links a {
            color: #3498db;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
        .row {
            display: flex;
            justify-content: space-between;
        }

        .col-6 {
            flex: 0 0 48%;
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 8px;
        }
        .section-title {
            font-size: 1.5em;
            color: #2980b9;
            margin-bottom: 10px;
        }

        .section-content p {
            margin: 5px 0;
        }

        .stars {
    display: inline-block;
    position: relative;
    font-size: 24px;
    line-height: 1;
}

.stars::before {
    content: "★★★★★"; 
    letter-spacing: 3px;
    background: linear-gradient(90deg, #ffc107 calc(var(--rating) * 20%), #e0e0e0 calc(var(--rating) * 20%));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stars[data-rating="1"] {
    --rating: 1;
}
.stars[data-rating="2"] {
    --rating: 2;
}
.stars[data-rating="3"] {
    --rating: 3;
}
.stars[data-rating="4"] {
    --rating: 4;
}
.stars[data-rating="5"] {
    --rating: 5;
}

    </style>
</head>
<body>

    <div class="container">
        @if ($user->image == null)
            <div class="user-image">
                <img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('assets/img/faces/6.jpg'))) }}" alt="User Photo" style="max-width: 150px; border-radius: 50%; margin-bottom: 15px;">
            </div>
        @else
            <div class="user-image">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($user->image))) }}" alt="User Photo" style="max-width: 150px; border-radius: 50%; margin-bottom: 15px;">
            </div>
        @endif
    
    
        <div class="header" style="margin-top: -134px;">
          
            <h1>{{$user->first_name}} {{$user->last_name}}</h1>
            <p>{{$user->scopework->name_en}} | {{$user->jobtitle->name_en}}</p>
            <p>{{$user->email}} | {{$user->phone}} </p> 

            <p>
                @if($user->businessgallery)
                    @foreach ($user->businessgallery as $businessgallery)
                        <a href="{{ $businessgallery->link ?? '#' }}">{{ $businessgallery->name ?? 'No name' }} | </a>
                    @endforeach
                @else
                    <span>No business gallery available</span>
                @endif
            </p>

            <p>
              @if($user && $user->userdetails)
                {{$user->userdetails->description}}
              @else
              
              @endif
            </p>
        </div>

          <!-- المعلومات الشخصية -->
         <div class="row">
          <div class="col-6">
            <div class="section">
              <div class="section-title">personal information</div>
              <div class="section-content">
               
                <p><strong>gender:</strong> {{ $user->gender ?? 'Not specified' }}</p>
                <p><strong>birthday:</strong> {{ $user->birthday ?? 'Not specified' }}</p>
                <p><strong>nationality:</strong> {{ $user->nationality ?? 'Not specified' }}</p>
                <p><strong>city:</strong> {{ $user->city->name_en ?? 'Not specified' }}</p>
                <p><strong>address:</strong> {{ $user->address ?? 'Not specified' }}</p>
                
                 

              </div>
            </div>
          </div>

          <div class="col-6">
            <div class="section">
              <div class="section-title">Details</div>
              <div class="section-content">
                <p><strong>years experience:</strong> {{ $user->userdetails->years_experience ?? 'Not specified' }}</p>
                <p><strong>educational level:</strong> {{ $user->userdetails->educational_level ?? 'Not specified' }}</p>
                <p><strong>career level:</strong> {{ $user->userdetails->career_level ?? 'Not specified' }}</p>
                <p><strong>type job:</strong> {{ $user->userdetails->type_job ?? 'Not specified' }}</p>
                <p><strong>status:</strong> {{ $user->userdetails->status_employee ?? 'Not specified' }}</p>
                <p><strong>range salary:</strong> {{ $user->userdetails->rang_salary ?? 'Not specified' }}</p>
            </div>
            
            </div>
          </div>
         </div>

   

       

        <div class="row">
            <div class="col-6">
                <div class="section skills">
                    <div class="section-title">Skills</div>
                    <div class="section-content">
                        @if($user->skill)
                            <ul class="skills-list">
                                @foreach ($user->skill as $skill)
                                    <li><strong>name:</strong> {{ $skill->name ?? 'No skill name' }} {{ $skill->Level ?? 'No level' }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No skills available</p>
                        @endif
                       

                        
                    </div>
                </div>
            </div>

            <div class="col-6">
                        
                <!-- اللغات -->
                <div class="section languages">
                    <div class="section-title">Languages</div>
                    <div class="section-content">
                        @if($user->language)
                            <ul class="languages-list">
                                @foreach ($user->language as $language)
                                    <li>
                                        <strong>{{ $language->name ?? 'No language' }}:</strong>
                                        <div class="stars" data-rating="{{ $language->rang ?? 0 }}"></div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No languages available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        
                <!-- الخبرات -->
                <div class="section experience">
                    <div class="section-title">Work Experience</div>
                    <div class="section-content">
                    @foreach ($user->experience as $experien)
                        
                    
                        <h3>{{$experien->jobtitle->name_en}}</h3>
                        <p>{{$experien->name_company}} Company | {{$experien->from_date}} - {{$experien->to_date}} </p>
                        <p>{{$experien->text}}</p>
                    @endforeach

                    </div>
                </div>


        
     
      
        {{-- <!-- الروابط الشخصية -->
        <div class="section links">
            <div class="section-title">Portfolio & Links</div>
            <div class="section-content">
               
            </div>
        </div> --}}



          <!-- التعليم -->
          <div class="section education">
            <div class="section-title">Education</div>
            <div class="section-content">
                @foreach ($user->certificate as $certificate)
                <div class="certificate-item">
                    <div class="certificate-details">
                        <h3>{{$certificate->certificate_name}}</h3>
                        <p>{{$certificate->certificate_type}}</p>
                    </div>
                    <div class="user-image">
                        <img src="{{public_path($certificate->image)}}" alt="User Photo">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
    </div>

</body>
</html>
