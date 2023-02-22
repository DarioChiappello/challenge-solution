<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Company;
use App\Entity\Sale;
use Doctrine\ORM\EntityManagerInterface;

class CompanyController extends AbstractController
{
    /**
     * @Route("/company", name="app_company")
     */
    public function index(EntityManagerInterface $em): JsonResponse
    {
        $companies = $em->getRepository(Company::class)->findAll();

        foreach($companies as $company){
            $companyId = $company->getId();
            $company_sales = $this->getDoctrine()->getRepository(Sale::class)->findBy(array('companyId' => $companyId));
            $company->setSales($company_sales);
            
        }

        return $this->json([
            'companies' => $companies
        ]);
    }

    public function showCompany($id)
    {
        $company = $this->getDoctrine()->getRepository(Company::class)->find($id);

        $companyId = $company->getId();

        $sales = $this->getDoctrine()->getRepository(Sale::class)->findBy(array('companyId' => $companyId));

        $company->setSales($sales);

        return $this->json([
            'company' => $company,
        ]);
    }
}
