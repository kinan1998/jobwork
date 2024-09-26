<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\JobTitleResource;
use App\Http\Resources\ScopeWorkResource;
use Illuminate\Http\Resources\Json\JsonResource;

class JobOpportunityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
           
            'gender' => $this->gender,
            'from_age' => $this->from_age,
            'to_age' => $this->to_age,
            'educational_level' => $this->educational_level,
            'career_level' => $this->career_level,
            'years_experience' => $this->years_experience,
            'number_vacancies' => $this->number_vacancies,
            'address' => $this->address,
            'type_job' => $this->type_job,
            'question' =>$this->question,
            'rang_salary' => $this->rang_salary,
            'job_description' => $this->job_description,
            'requirements' => $this->requirements,
            'requirements_for_trainees' => $this->requirements_for_trainees,
         
            
            'created_at' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->diffForHumans(),
            'company' => new CompanyResource($this->whenLoaded('company')),
            'jobtitle' => new JobTitleResource($this->whenLoaded('jobtitle')),
            'scopework' => new ScopeWorkResource($this->whenLoaded('scopework')),
            'city' => new CityResource($this->whenLoaded('city')),
        ];
    }
}
