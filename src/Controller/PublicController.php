<?php

/**
 * Routes Controller
 *
 * Controla as rotas do App
 *
 * @copyright Copyright (c) Zeravat (http://zeravat.com.br)
 * @author The Oceaning - www.oceaning.com.br
 * @version 1
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\Validation\Validation;
use Cake\Mailer\Email;
use Cake\Controller\Component\RequestHandlerComponent;
use Cake\Network\Request;
use Cake\Utility\Security;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;
use Cake\I18n\Time;

// require('/webroot/tools/gerencianet/autoload.php');
require( $_SERVER['DOCUMENT_ROOT'] . '/tools/gerencianet/autoload.php');


use Gerencianet\Exception\GerencianetException;
use Gerencianet\Gerencianet;


class PublicController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function home()
    {
        $this->viewBuilder()->layout('public');
        $this->set('title', '');
        $this->set('script', ['public']);
        $this->set('css', ['default', 'public']);
        $this->set('description', '');

        $query_citys = "";

        // Busca Activity
        $citys = TableRegistry::get('Citys');
        $query_citys = $citys
            ->find();

        $this->set('query_citys', $query_citys);

        return $this->redirect('/login');
    }

    public function display()
    {
        $this->viewBuilder()->layout('public');
        $this->set('script', ['public']);
        $this->set('css', ['default', 'public']);
        $this->set('meta', '');
        $this->set('description', '');
        $step_temp = $this->Cookie->read('step_temp');

        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }

        switch ($page) {

            // PUBLIC

            case 'cadastro':
                $this->set('title', 'Cadastro - ');
                $this->set('script', ['public']);
                $this->set('script', ['register', 'public']);
                $this->set('css', ['default', 'login']);
                $this->set('description', '');
                error_log(print_r("cadastro", true));

                break;

            case 'dados-empresariais':
                $this->set('title', 'Dados empresariais - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                error_log(print_r("dados-empresariais", true));

                break;

            case 'especialidades/ecommerce':
                $this->set('title', 'e-Commerce - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Veja como um especialista em contabilidade no segmento de e-Commerce tem papel fundamental na gestão do seu negócio com a Link Contabilidade Consultiva.');
                error_log(print_r("especialidades", true));

                break;

            case 'especialidades/transportadoras':
                $this->set('title', 'Transportadoras - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Reduza custos tributários e tenha apoio na gestão da sua empresa com a Link Contabilidade Consultiva! Sua contabilidade digital lucrativa e segura!');
                break;

            case 'especialidades/comercio':
                $this->set('title', 'Comércio - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Quer uma contabilidade especializada para a gestão do seu comércio? A Link Contabilidade Consultiva pode te ajudar! Clique para saber mais.');
                break;

            case 'especialidades/empresas-de-servicos':
                $this->set('title', 'Empresas de Serviços - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'A Link Contabilidade Consultiva tem soluções fiscais, contábeis e financeira para decolar sua empresa de serviços! Sua contabilidade digital lucrativa e segura!');
                break;

            case 'especialidades/farmacias-e-drogarias':
                $this->set('title', 'Farmácias e Drogarias - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Dificuldade com a tributação de medicamentos? A Link Contabilidade Consultiva te ajuda na gestão da sua farmácia ou drogaria!');
                break;

            case 'especialidades/hoteis-e-pousadas':
                $this->set('title', 'Hóteis e Pousadas - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Qual a importância da contabilidade no ramo de hotéis e pousadas? Clique agora e veja as vantagens que a Link Contabilidade pode oferecer para a sua empresa!');
                break;

            case 'especialidades/industrias':
                $this->set('title', 'Indústrias - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Qual a importância da Contabilidade Especializada para Indústrias? Saiba como a Link Contabilidade Consultiva pode transformar o seu negócio! Sua contabilidade digital lucrativa e segura!');
                break;

            case 'especialidades/terceiro-setor':
                $this->set('title', 'Terceiro Setor - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Tenha uma melhor gestão da sua entidade com a Link Contabilidade Consultiva! Sua contabilidade digital lucrativa e segura!');
                break;

            case 'especialidades/padarias':
                $this->set('title', 'Padarias - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Quer aumentar a lucratividade da sua padaria? A Link Contabilidade Consultiva pode te ajudar! Clique para saber mais.');
                break;

            case 'especialidades/supermercados':
                $this->set('title', 'Supermercados - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'A Link Contabilidade Consultiva auxilia todos os setores do seu supermercado! Clique para saber mais sobre como podemos transformar o seu negócio. Sua contabilidade digital lucrativa e segura!');
                break;

            case 'solucoes/analise-de-recuperacao-de-impostos-do-simples-nacional':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'solucoes/analise-tributaria':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'solucoes/area-contabil':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'solucoes/area-do-imposto-de-renda':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'solucoes/area-fiscal':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'solucoes/area-societaria':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'solucoes/area-trabalhista-e-previdenciaria':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'solucoes/contabilidade-consultiva':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'O que a sua empresa pode ganhar com a contabilidade consultiva? Saiba como a Link Contabilidade pode impulsionar o seu negócio! Sua contabilidade digital lucrativa e segura!');
                break;

            case 'solucoes/gestor-empresarial-erp':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'solucoes/gestor-financeiro':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Venha para a Link Contabilidade Consultiva e tenha acesso a um programa de gestão financeira sem custo adicional! Suas operações financeiras organizadas de forma prática e eficiente.');
                break;

            case 'solucoes/contabilidade-lucro-real':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Ainda está inseguro sobre a aplicação do regime Lucro Real na sua empresa? A Link Contabilidade te dá o apoio necessário para o sucesso do seu negócio!');
                break;

            case 'solucoes/contabilidade-lucro-presumido':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Qual melhor regime tributário ¬para a sua empresa? Saiba mais sobre Lucro Presumido, o segundo regime com maior presença no Brasil!');
                break;

            case 'solucoes/contabilidade-simples-nacional':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Tem uma empresa Simples Nacional? Saiba mais sobre como a Link Contabilidade Consultiva pode te ajudar nos processos do seu negócio!');
                break;

            case 'solucoes/nossos-planos':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'A Link Contabilidade Consultiva está dividida em dois planos que se adapta perfeitamente ao perfil do seu negócio, encontre o plano ideal para a sua empresa!');
                break;

            case 'solucoes/servicos-tecnicos':
                $this->set('title', 'Soluções - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'A Link Contabilidade Consultiva desenvolve um trabalho minucioso de análise técnica das áreas fiscal, tributária e trabalhista para pessoa física ou jurídica. Sua contabilidade digital lucrativa e segura!');
                break;

            case 'extras/ebooks':
                $this->set('title', 'Ebooks - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Baixe agora e-books com informações essenciais para a gestão do seu negócio! Abertura de Empresa, Planejamento Tributário... ');
                break;

            case 'extras/planilhas':
                $this->set('title', 'Planilhas - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Baixe agora planilhas gratuitas que vão te ajudar a organizar melhor a sua empresa! Relatório Gerencial, Fluxo de Caixa, Controle de Estoque...');
                break;

            case 'extras/central-de-ajuda':
                $this->set('title', 'Central de ajuda - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Tire suas dúvidas com a nossa central de ajuda. Aqui você encontra as perguntas mais frequentes sobre a Link Contabilidade. Sua contabilidade digital lucrativa e segura!');
                break;

            case 'abertura-de-empresa':
                $this->set('title', 'Abertura de empresa - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'migracao-de-empresa':
                $this->set('title', 'Migração de empresa - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'abrir-empresa-gratis':
                $this->set('title', 'Abrir empresa Grátis - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Clique agora para criar sua empresa de forma simples e gratuita com a Link Contabilidade Consultiva!');
                break;

            case 'abrir-empresa-gratis-produtos':
                $this->set('title', 'Abrir empresa Grátis - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Clique agora para criar sua empresa de forma simples e gratuita com a Link Contabilidade Consultiva!');
                break;

            case 'ja-tenho-empresa':
                $this->set('title', 'Já tenho empresa - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Traga sua empresa para a Link Contabilidade Consultiva de forma simples e fácil! Serviço especializado para a sua empresa.');
                break;

            case 'ja-tenho-empresa-produtos':
                $this->set('title', 'Já tenho empresa - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Traga sua empresa para a Link Contabilidade Consultiva de forma simples e fácil! Serviço especializado para a sua empresa.');
                break;

            case 'quem-somos':
                $this->set('title', 'Quem somos - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Saiba mais sobre a Link Contabilidade Consultiva! Sua contabilidade digital lucrativa e segura! Venha para a Link e conheça as vantagens para sua empresa. Transforme sua Empresa através da Contabilidade Consultiva.');
                break;

            case 'parceiros':
                $this->set('title', 'Quem somos - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                break;

            case 'blog':
                $this->set('title', 'Blog - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Matérias e notícias sobre o mundo empresarial sempre na palma da sua mão.
                Clique agora para conhecer o blog da Link Contabilidade!');
                break;

            case 'contabilidade-para-ecommerce-como-funciona':
                $this->set('title', 'Contabilidade para e-commerce: Como funciona? - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Dúvidas sobre e-commerce? Veja como funciona a contabilidade para esse setor e os fatores importantes para quem opta por esse modelo de negócio!');
                break;

            case 'contabilidade-durante-a-pandemia-entenda-a-importancia-da-gestao-contabil':
                $this->set('title', 'Contabilidade durante a Pandemia: Entenda a importância da gestão contábil - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Como uma gestão contábil pode ajudar a sua empresa na pandemia? Entenda o porquê do papel do contador neste momento é essencial!');
                break;
                  
            case '5-vantagens-da-contabilidade-digital-que-voce-precisa-experimentar':
                $this->set('title', '5 vantagens da contabilidade digital que você precisa experimentar - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Saiba 5 vantagens que a contabilidade digital pode oferecer para a sua empresa! Link Contabilidade Consultiva, sua contabilidade digital lucrativa e segura!');
                break;

            case 'tudo-o-que-precisa-saber-antes-de-abrir-a-sua-empresa':
                $this->set('title', 'Tudo o que precisa saber antes de abrir a sua empresa - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Está pensando em abrir a sua empresa? Entenda o que é necessário para dar o primeiro passo da vida empreendedora!');
                break;

            case 'simples-nacional-tudo-o-que-voce-precisa-saber':
                $this->set('title', 'Simples Nacional: Tudo o que você precisa saber - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Dúvidas sobre o Simples Nacional? Clique para saber tudo sobre esse regime tributário!');
                break;
                
            case 'o-que-e-e-para-que-serve-um-cnpj':
                $this->set('title', 'O que é e para que serve um CNPJ? - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'O que é e para que serve um CNPJ? Clique para saber mais sobre a importância do CNPJ para a sua empresa.');
                break;

            case 'toda-empresa-precisa-de-um-contador':
                $this->set('title', 'Toda empresa precisa de um Contador? - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Será que toda empresa precisa de um contador? Saiba mais sobre como a contabilidade consultiva é fundamental na gestão do seu negócio!');
                break;

            case 'imposto-de-renda-pessoa-juridica':
                $this->set('title', 'Imposto de renda pessoa jurídica (IRPJ) - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Aprenda como declarar seu imposto de renda sem estresse! A Link te ensina os passos importantes na hora de prestar contas à Receita Federal.');
                break;

            case 'por-que-uma-empresa-precisa-emitir-nfe':
                $this->set('title', 'Por que uma empresa precisa emitir NFe? - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Por que uma empresa precisa emitir NFe? Clique agora para saber a importância da emissão de Notas Ficas Eletrônicas!');
                break;

            case 'quais-os-melhores-aplicativos-para-empresas':
                $this->set('title', 'Quais os melhores Aplicativos para empresas? - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Os melhores aplicativos para a gestão do seu negócio na palma da sua mão. Clique e veja como esses apps podem te ajudar no dia a dia da sua empresa!');
                break;

            case 'tendencias-de-negocios-o-que-a-pandemia-nos-mostrou':
                $this->set('title', 'Tendências de Negócios: O que a Pandemia nos mostrou? - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Como a pandemia afetou o seu negócio? Entenda quais as tendências que essa mudança mundial trouxe para o mercado!');
                break;

            case 'fale-conosco':
                $this->set('title', 'Fale conosco - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Seja bem-vindo a Link Contabilidade Consultiva! Queremos levar a contabilidade consultiva para ajudar na gestão do seu negócio.');
                break;

            case 'politica-de-privacidade':
                $this->set('title', 'Politíca de privacidade - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'A LINK valoriza a privacidade de seus usuários e criou esta Política de Privacidade para demonstrar seu compromisso em proteger a sua privacidade e seus dados pessoais, nos termos da Lei Geral de Proteção de Dados e...');
                break;

            case 'codigo-de-etica':
                $this->set('title', 'Politíca de privacidade - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '... satisfação dos seus clientes e instituições congêneres, buscando sempre manter sólida reputação, com a consciência de sua responsabilidade social e ambiental...');
                break;

            case 'termos-de-uso':
                $this->set('title', 'Termos de uso - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Termos e Condições de Compra e Venda de Link Contabilidade Consultiva Digital, com sede na Av. Dr. João Baptista Soares de Queiroz Júnior, 235 - Jardim das Industrias.');
                break;

            // ABERTURA
            case 'abertura-s':
                $this->Cookie->write('service_type', 's');
                $this->Cookie->write('service_action', 'abertura');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'abertura-c':
                $this->Cookie->write('service_type', 'c');
                $this->Cookie->write('service_action', 'abertura');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'abertura-sc':
                $this->Cookie->write('service_type', 'sc');
                $this->Cookie->write('service_action', 'abertura');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'abertura-mei':
                $this->Cookie->write('service_type', 'mei');
                $this->Cookie->write('service_action', 'abertura');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'abertura-ind':
                $this->Cookie->write('service_type', 'ind');
                $this->Cookie->write('service_action', 'abertura');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'abertura-domestico':
                $this->Cookie->write('service_type', 'domestico');
                $this->Cookie->write('service_action', 'abertura');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'abertura-liberal':
                $this->Cookie->write('service_type', 'liberal');
                $this->Cookie->write('service_action', 'abertura');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'abertura-inativa':
                $this->Cookie->write('service_type', 'inativa');
                $this->Cookie->write('service_action', 'abertura');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'abertura-industria':
                $this->Cookie->write('service_type', 'industria');
                $this->Cookie->write('service_action', 'abertura');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            // MIGRAÇÃO
            case 'migracao-s':
                $this->Cookie->write('service_type', 's');
                $this->Cookie->write('service_action', 'migracao');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'migracao-c':
                $this->Cookie->write('service_type', 'c');
                $this->Cookie->write('service_action', 'migracao');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'migracao-sc':
                $this->Cookie->write('service_type', 'sc');
                $this->Cookie->write('service_action', 'migracao');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'migracao-mei':
                $this->Cookie->write('service_type', 'mei');
                $this->Cookie->write('service_action', 'migracao');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'migracao-domestico':
                $this->Cookie->write('service_type', 'domestico');
                $this->Cookie->write('service_action', 'migracao');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;
    
            case 'migracao-liberal':
                $this->Cookie->write('service_type', 'liberal');
                $this->Cookie->write('service_action', 'migracao');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'migracao-inativa':
                $this->Cookie->write('service_type', 'inativa');
                $this->Cookie->write('service_action', 'migracao');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            case 'migracao-industria':
                $this->Cookie->write('service_type', 'industria');
                $this->Cookie->write('service_action', 'migracao');
                $this->Cookie->write('service_taxation', 'simples');
                $this->Cookie->write('service_plan', 'consultiva');
                $this->set('description', '');

                return $this->redirect('/contratar/etapa-1');
                break;

            // PAGINAS
            case 'contratar/etapa-1':
                $this->set('title', 'Contratar - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', 'Venha para a contabilidade digital com a Link Contabilidade Consultiva! Sua contabilidade digital lucrativa e segura.');

                $user_id = $this->Cookie->read('user_id');
                $business_id = $this->Cookie->read('business_id');

                $this->set('service_type', $this->Cookie->read('service_type'));
                $this->set('service_action', $this->Cookie->read('service_action'));
                $this->set('service_taxation', $this->Cookie->read('service_taxation'));
                $this->set('service_plan', $this->Cookie->read('service_plan'));
                $this->set('description', '');

                if($step_temp != "payment"){
                    $this->Cookie->write('step_temp', '1');
                }else{
                    return $this->redirect('/contratar/etapa-5');
                }

                // Buscar registros
                $query = TableRegistry::get('Services');
                $query_services = $query
                        ->find()
                        ->where([
                            'type =' => $this->Cookie->read('service_type'),
                            'action =' => $this->Cookie->read('service_action'),
                            'taxation =' => $this->Cookie->read('service_taxation'),
                            'plan =' => $this->Cookie->read('service_plan')
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Users');
                $query_users = $query
                        ->find()
                        ->where([
                            'id =' => $user_id
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Business');
                $query_business = $query
                        ->find()
                        ->where([
                            'id =' => $business_id
                        ]);

                $this->set('all_business', $query_business);
                $this->set('all_users', $query_users);
                $this->set('all_services', $query_services);

                break;

            case 'contratar/etapa-2':
                $this->set('title', 'Contratar - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                $user_id = $this->Cookie->read('user_id');
                $business_id = $this->Cookie->read('business_id');

                $this->set('service_type', $this->Cookie->read('service_type'));
                $this->set('service_action', $this->Cookie->read('service_action'));
                $this->set('service_taxation', $this->Cookie->read('service_taxation'));
                $this->set('service_plan', $this->Cookie->read('service_plan'));
                $this->set('description', '');

                // Bloqueio
                if($user_id == ""){
                    return $this->redirect('/contratar/etapa-1');
                }

                // Assinatura
                if($step_temp != "payment"){
                    $this->Cookie->write('step_temp', '2');
                }else{
                    return $this->redirect('/contratar/etapa-5');
                }

                // Buscar registros
                $query = TableRegistry::get('Services');
                $query_services = $query
                        ->find()
                        ->where([
                            'type =' => $this->Cookie->read('service_type'),
                            'action =' => $this->Cookie->read('service_action'),
                            'taxation =' => $this->Cookie->read('service_taxation'),
                            'plan =' => $this->Cookie->read('service_plan')
                        ]);
                foreach($query_services as $services_data){
                    $business_plano = $services_data->plan;
                }
                // Buscar registros
                $query = TableRegistry::get('Users');
                $query_users = $query
                        ->find()
                        ->where([
                            'id =' => $user_id
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Business');
                $query_business = $query
                        ->find()
                        ->where([
                            'id =' => $business_id
                        ]);
                        
                $this->set('all_business', $query_business);
                $this->set('all_users', $query_users);
                $this->set('all_services', $query_services);

                break;

            case 'contratar/etapa-3':
                $this->set('title', 'Contratar - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                $user_id = $this->Cookie->read('user_id');
                $business_id = $this->Cookie->read('business_id');

                $this->set('service_type', $this->Cookie->read('service_type'));
                $this->set('service_action', $this->Cookie->read('service_action'));
                $this->set('service_taxation', $this->Cookie->read('service_taxation'));
                $this->set('service_plan', $this->Cookie->read('service_plan'));
                $this->set('description', '');
                // Bloqueio
                if($user_id == ""){
                    return $this->redirect('/contratar/etapa-1');
                }

                // Assinatura
                if($step_temp != "payment"){
                    $this->Cookie->write('step_temp', '3');
                }else{
                    return $this->redirect('/contratar/etapa-5');
                }

                // Buscar registros
                $query = TableRegistry::get('Services');
                $query_services = $query
                        ->find()
                        ->where([
                            'type =' => $this->Cookie->read('service_type'),
                            'action =' => $this->Cookie->read('service_action'),
                            'taxation =' => $this->Cookie->read('service_taxation'),
                            'plan =' => $this->Cookie->read('service_plan')
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Users');
                $query_users = $query
                        ->find()
                        ->where([
                            'id =' => $user_id
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Business');
                $query_business = $query
                        ->find()
                        ->where([
                            'id =' => $business_id
                        ]);

                $this->set('all_business', $query_business);
                $this->set('all_users', $query_users);
                $this->set('all_services', $query_services);

                break;

            case 'contratar/etapa-4':
                $this->set('title', 'Contratar - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                $user_id = $this->Cookie->read('user_id');
                $business_id = $this->Cookie->read('business_id');

                $this->set('service_type', $this->Cookie->read('service_type'));
                $this->set('service_action', $this->Cookie->read('service_action'));
                $this->set('service_taxation', $this->Cookie->read('service_taxation'));
                $this->set('service_plan', $this->Cookie->read('service_plan'));
                $this->set('description', '');

                // Bloqueio
                if($user_id == ""){
                    return $this->redirect('/contratar/etapa-1');
                }

                // Assinatura
                if($step_temp != "payment"){
                    $this->Cookie->write('step_temp', '4');
                }else{
                    return $this->redirect('/contratar/etapa-5');
                }

                // Buscar registros
                $query = TableRegistry::get('Services');
                $query_services = $query
                        ->find()
                        ->where([
                            'type =' => $this->Cookie->read('service_type'),
                            'action =' => $this->Cookie->read('service_action'),
                            'taxation =' => $this->Cookie->read('service_taxation'),
                            'plan =' => $this->Cookie->read('service_plan')
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Users');
                $query_users = $query
                        ->find()
                        ->where([
                            'id =' => $user_id
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Business');
                $query_business = $query
                        ->find()
                        ->where([
                            'id =' => $business_id
                        ]);

                $this->set('all_business', $query_business);
                $this->set('all_users', $query_users);
                $this->set('all_services', $query_services);

                $query_citys = "";

                // Busca Activity
                $citys = TableRegistry::get('Citys');
                $query_citys = $citys
                    ->find();

                $this->set('query_citys', $query_citys);

                break;

            case 'contratar/etapa-5':
                $this->set('title', 'Contratar - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                $user_id = $this->Cookie->read('user_id');
                $business_id = $this->Cookie->read('business_id');

                $this->set('service_type', $this->Cookie->read('service_type'));
                $this->set('service_action', $this->Cookie->read('service_action'));
                $this->set('service_taxation', $this->Cookie->read('service_taxation'));
                $this->set('service_plan', $this->Cookie->read('service_plan'));

                // Bloqueio
                if($user_id == ""){
                    return $this->redirect('/contratar/etapa-1');
                }

                // Assinatura
                $this->Cookie->write('step_temp', 'payment');

                // Buscar registros
                $query = TableRegistry::get('Services');
                $query_services = $query
                        ->find()
                        ->where([
                            'type =' => $this->Cookie->read('service_type'),
                            'action =' => $this->Cookie->read('service_action'),
                            'taxation =' => $this->Cookie->read('service_taxation'),
                            'plan =' => $this->Cookie->read('service_plan'),
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Users');
                $query_users = $query
                        ->find()
                        ->where([
                            'id =' => $user_id
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Business');
                $query_business = $query
                        ->find()
                        ->where([
                            'id =' => $business_id
                        ]);

                // Buscar registros
                $query = TableRegistry::get('Payments');
                $query_payments = $query
                        ->find()
                        ->where([
                            'business_id =' => $business_id
                        ]);

                // Verifica assinaturas
                $business_sign = 0;
                // $business_terms = 0;

                foreach ($query_business as $business) {
                    $business_sign = $business->sign;
                    // $business_terms = $business->terms;
                }

                if($business_sign == 0){
                    return $this->redirect('/contratar/etapa-4');
                }

                $this->set('all_business', $query_business);
                $this->set('all_users', $query_users);
                $this->set('all_services', $query_services);
                $this->set('all_payments', $query_payments);

                break;

            case 'contratar/etapa-final':
                $this->set('title', 'Contratar - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('description', '');
                $this->set('service_type', $this->Cookie->read('service_type'));
                $this->set('service_action', $this->Cookie->read('service_action'));
                $this->set('service_taxation', $this->Cookie->read('service_taxation'));
                
                $this->Cookie->write('step_temp', '');
                $this->Cookie->write('user_id', '');
                $this->Cookie->write('business_id', '');
                $this->set('description', '');

                break;

            case 'contato-sucesso':
                $this->set('title', 'Contato - ');
                $this->set('script', ['public']);
                $this->set('css', ['default', 'public']);
                $this->set('meta', '');
                $this->set('description', '');
                break;
        }

        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }

    }

    // SEND
    // STEP 1

    public function businessAddStep1()
    {
        if ($this->request->is('post')) {

            // Token
            function generateToken($length = 500) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            $date_now = Time::now();
            $token = generateToken();

            $user_id = $this->Cookie->read('user_id');
            $service_type = $this->Cookie->read('service_type');
            $service_action = $this->Cookie->read('service_action');

            $query = TableRegistry::get('Users');
            $query_data = $query
                    ->find()
                    ->where([
                        'id =' => $user_id
                    ]);
            $results = $query_data->toArray();
            if(!isset($results[0])){
                $user_id = "";
            }

            if ($user_id == ""){

                // Cria nova Quotations
                $users = TableRegistry::get('Users');
                $user = $users->newEntity();
                $user->name = $this->request->data['name'];
                $user->lastname = $this->request->data['lastname'];
                $user->username = $this->request->data['username'];
                $user->password = $this->request->data['password'];
                $user->cpf = $this->request->data['cpf'];
                $user->phone = $this->request->data['phone'];
                $user->whatsapp = $this->request->data['whatsapp'];
                $user->birthday = $this->request->data['birthday'];
                $user->token = $token;
                $user->image = "default";
                $user->created = $date_now;
                $user->updated = $date_now;
                $user->active_login = $date_now;
                $user->last_login = $date_now;
                $user->indication = $this->request->data['indication'];
                $user->outros = $this->request->data['outros'];
                $user->origin = "website";
                $user->permission = 1;
                $user->logged = 0;
                $user->status = 1;
                $user->como_conheceu = $this->request->data['como_conheceu'];
                $users->save($user);

                $this->Cookie->write('user_id', $user->id);

            }else{

                $password = $this->request->data['password'];
                $hasher = new DefaultPasswordHasher();

                // Atualiza Quotation
                $query = TableRegistry::get('Users');
                $query_users = $query->query();
                $query_users->update()
                    ->set([
                        'name' => $this->request->data['name'],
                        'lastname' => $this->request->data['lastname'],
                        'username' => $this->request->data['username'],
                        'password' => $hasher->hash($password),
                        'cpf' => $this->request->data['cpf'],
                        'phone' => $this->request->data['phone'],
                        'whatsapp' => $this->request->data['whatsapp'],
                        'birthday' => $this->request->data['birthday'],
                        'como_conheceu' => $this->request->data['como_conheceu'],
                        'indication' => $this->request->data['indication'],
                        'outros' => $this->request->data['outros'],
                        'updated' => $date_now
                    ])
                    ->where(['id' => $user_id])
                    ->execute();

            }

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // STEP 2
    public function businessAddStep2()
    {
        if ($this->request->is('post')) {

            $date_now = Time::now();

            $user_id = $this->Cookie->read('user_id');
            $service_type = $this->Cookie->read('service_type');
            $service_action = $this->Cookie->read('service_action');
            $service_taxation = $this->Cookie->read('service_taxation');
            $service_plan = $this->Cookie->read('service_plan');
            
            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users = $query
                    ->find()
                    ->where([
                        'id =' => $user_id
                    ]);

            foreach ($query_users as $user) {
                $user_cpf = $user->cpf;
            }

            // Buscar registros
            $query = TableRegistry::get('Services');
            $query_services = $query
                    ->find()
                    ->where([
                        'type =' => $service_type,
                        'action =' => $service_action,
                        'taxation =' => $service_taxation,
                        'plan =' => $service_plan
                    ]);

            foreach ($query_services as $service) {
                $service_id = $service->id;
                $service_price = $service->price;
            }

            // Business
            $business_socios = 1;
            $business_funcionarios = 0;
            $business_faturamento = 0;
            $business_pessoal = 0;
            $business_extra = 0;

            $business_socios = $this->request->data['socios'];
            $business_funcionarios = $this->request->data['funcionarios'];
            $business_faturamento = $this->request->data['faturamento'];

            $total_month = $service_price;
            $business_pessoal = $business_socios + $business_funcionarios;

            if($business_pessoal > 5){
                $total_month += ($business_pessoal - 5) * 60.00;
                $business_extra = ($business_pessoal - 5);
            }

            if($business_faturamento > 1){
                $total_month += ($business_faturamento - 1) * 200;
            }
            
             $query = TableRegistry::get('Business');
             $query_business = $query
                     ->find()
                     ->where([
                         'id =' => $this->Cookie->read('business_id')
                     ]);
 
            $results_query = $query_business->toArray();
            if(!isset($results_query[0])){
                 $business_id = NULL; 
             }else{
                $business_id = $this->Cookie->read('business_id');
             }

            if ($business_id == NULL){

                // Cria nova Quotations
                $query = TableRegistry::get('Business');
                $business = $query->newEntity();

                // Verifica tipo
                if($service_action == "abertura"){

                    $business->fantasia = $this->request->data['name'];
                    $business->atividades = $this->request->data['atividades'];
                }else{

                    $business->razao = $this->request->data['razao'];
                    $business->fantasia = $this->request->data['fantasia'];
                    $business->cnpj = $this->request->data['cnpj'];
                }

                $business->cpf = $user_cpf;
                $business->action = $service_action;
                $business->type = $service_type;
                $business->taxation = $this->request->data['taxation'];
                $business->faturamento = $this->request->data['faturamento'];
                $business->socios = $this->request->data['socios'];
                $business->funcionarios = $this->request->data['funcionarios'];
                $business->sign = 0;
                $business->sign_date = "";
                $business->steps = 2;
                $business->terms = 0;
                $business->terms_date = "";
                $business->created = $date_now;
                $business->updated = $date_now;
                $business->status = 1;
                $query->save($business);

                // Cria nova Quotations
                $query = TableRegistry::get('AccessBusiness');
                $access = $query->newEntity();
                $access->user_id = $user_id;
                $access->business_id = $business->id;
                $access->status = 1;
                $query->save($access);

                // Cria nova Quotations
                $query = TableRegistry::get('ServicesBusiness');
                $services = $query->newEntity();
                $services->business_id = $business->id;
                $services->service_id = $service_id;
                $services->status = 1;
                $query->save($services);

                // Cria nova Quotations
                $query = TableRegistry::get('Payments');
                $payments = $query->newEntity();
                $payments->business_id = $business->id;
                $payments->type = "none";
                $payments->amount = $total_month;
                $payments->maturity = $date_now;
                $payments->status = 1;
                $query->save($payments);

                $this->Cookie->write('business_id', $business->id);

            }else{          

                // Atualiza Quotation
                $query = TableRegistry::get('Payments');
                $query_payments = $query->query();
                $query_payments->update()
                    ->set([
                        'amount' => $total_month,
                        'maturity' => $date_now
                    ])
                    ->where(['business_id' => $business_id])
                    ->execute();

                // Verifica tipo
                if($service_action == "abertura"){

                    // Atualiza Quotation
                    $query = TableRegistry::get('Business');
                    $query_business = $query->query();
                    $query_business->update()
                        ->set([
                            'fantasia' => $this->request->data['name'],
                            'action' => $service_action,
                            'type' => $service_type,
                            'taxation' => $this->request->data['taxation'],
                            'faturamento' => $this->request->data['faturamento'],
                            'socios' => $this->request->data['socios'],
                            'funcionarios' => $this->request->data['funcionarios'],
                            'atividades' => $this->request->data['atividades'],
                            'steps' => 2,
                            'updated' => $date_now
                        ])
                        ->where(['id' => $business_id])
                        ->execute();

                }else{

                    // Atualiza Quotation
                    $query = TableRegistry::get('Business');
                    $query_business = $query->query();
                    $query_business->update()
                        ->set([
                            'razao' => $this->request->data['razao'],
                            'fantasia' => $this->request->data['fantasia'],
                            'cnpj' => $this->request->data['cnpj'],
                            'action' => $service_action,
                            'type' => $service_type,
                            'taxation' => $this->request->data['taxation'],
                            'faturamento' => $this->request->data['faturamento'],
                            'socios' => $this->request->data['socios'],
                            'funcionarios' => $this->request->data['funcionarios'],
                            'steps' => 2,
                            'updated' => $date_now
                        ])
                        ->where(['id' => $business_id])
                        ->execute();
                }
            }

            // Atualiza Taxation selecionada
            $this->Cookie->write('service_taxation', $this->request->data['taxation']);

            $result = array(
                'status' => 'ok'
            );
            
        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    public function updateTaxation($type = null)
    {
        $service_id = 0;

        if ($this->request->is('post')) {

            $date_now = Time::now();
            
            $service_type = $this->Cookie->read('service_type');
            $service_action = $this->Cookie->read('service_action');
            $service_plan = $this->Cookie->read('service_plan');
            $service_taxation = $type;

            // Buscar registros
            $query = TableRegistry::get('Services');
            $query_services = $query
                    ->find()
                    ->where([
                        'type =' => $service_type,
                        'action =' => $service_action,
                        'taxation =' => $service_taxation,
                        'plan =' => $service_plan
                    ]);

            foreach ($query_services as $service) {
                $service_id = $service->id;
                $service_price = $service->price;
            }

            if($service_id == 0){

                $query = TableRegistry::get('Services');
                $query_services = $query
                        ->find()
                        ->where([
                            'type =' => $service_type,
                            'action =' => $service_action,
                            'taxation =' => $this->Cookie->read('service_taxation'),
                            'plan =' => $service_plan
                        ]);

                $results_query = $query_services->toArray();
                if(isset($results_query[0])){

                    $query = TableRegistry::get('Services');
                    $services = $query->newEntity();
                    $services->name = $results_query[0]['name'];
                    $services->text = $results_query[0]['text'];
                    $services->price = $results_query[0]['price'];
                    $services->action = $results_query[0]['action'];
                    $services->type = $results_query[0]['type'];
                    $services->taxation = $service_taxation;
                    $services->plan = $results_query[0]['plan'];
                    $services->cycle = $results_query[0]['cycle'];
                    $services->status = 1;
                    $query->save($services);

                    $this->Cookie->write('service_type', $service_type);
                    $this->Cookie->write('service_action', $service_action);
                    $this->Cookie->write('service_taxation', $service_taxation);
                    $this->Cookie->write('service_plan', $service_plan);
                    $this->set('description', '');
                    $result = array(
                        'status' =>  'ok'
                    );
                }
            }else{

                $this->Cookie->write('service_type', $service_type);
                $this->Cookie->write('service_action', $service_action);
                $this->Cookie->write('service_taxation', $service_taxation);
                $this->Cookie->write('service_plan', $service_plan);
                $this->set('description', '');

                $result = array(
                    'status' =>  'ok'
                );

            }

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    public function updateService($type = null)
    {
        
        if ($this->request->is('post')) {

            $date_now = Time::now();
        
            $service_type = $type;
            $service_action = $this->Cookie->read('service_action');
            $service_plan = $this->Cookie->read('service_plan');
            $service_taxation = $this->Cookie->read('service_taxation');
            $business_id = $this->Cookie->read('business_id');

            $query = TableRegistry::get('Services');
            $query_services = $query
                    ->find()
                    ->where([
                        'taxation =' => $service_taxation,
                        'action =' => $service_action,
                        'type =' => $service_type,
                        'plan =' => $service_plan
                    ]);

            foreach ($query_services as $service) {
                $service_id = $service->id;
                $new_service_taxation = $service->taxation;
                $new_service_action = $service->action;
                $new_service_type = $service->type;
                $new_service_plan = $service->plan;
            }


            $query = TableRegistry::get('ServicesBusiness');
            $query_business = $query->query();
            $query_business->update()
                ->set([
                    'service_id' => $service_id
                ])
                ->where(['business_id' => $business_id])
                ->execute();


            $this->Cookie->write('service_type', $new_service_type);
            $this->Cookie->write('service_action', $new_service_action);
            $this->Cookie->write('service_taxation', $new_service_taxation);
            $this->Cookie->write('service_plan', $new_service_plan);
            $this->set('description', '');

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    public function updatePlan($type = null)
    {
        
        if ($this->request->is('post')) {

            $date_now = Time::now();
        
            $service_type = $this->Cookie->read('service_type');
            $service_action = $this->Cookie->read('service_action');
            $service_taxation = $this->Cookie->read('service_taxation');
            $service_plan = $type;

            $query = TableRegistry::get('Services');
            $query_service = $query
                    ->find()
                    ->where([
                        'type =' => $service_type,
                        'action =' => $service_action,
                        'taxation =' => $service_taxation,
                        'plan =' => $service_plan
                    ]);

            $results = $query_service->toArray();
            if(isset($results[0])){
                $service_taxation = $results[0]['taxation'];
                $service_action = $results[0]['action'];
                $service_type = $results[0]['type'];
                $service_plan = $results[0]['plan'];

                $this->Cookie->write('service_type', $service_type);
                $this->Cookie->write('service_action', $service_action);
                $this->Cookie->write('service_taxation', $service_taxation);
                $this->Cookie->write('service_plan', $service_plan);
                $this->set('description', '');
                
                $result = array(
                    'status' =>  'ok'
                );

            }else{
                $query = TableRegistry::get('Services');
                $query_services = $query
                        ->find()
                        ->where([
                            'type =' => $service_type,
                            'action =' => $service_action,
                            'taxation =' => $service_taxation
                        ]);

                $results_query = $query_services->toArray();
                if(isset($results_query[0])){

                    $query = TableRegistry::get('Services');
                    $services = $query->newEntity();
                    $services->name = $results_query[0]['name'];
                    $services->text = $results_query[0]['text'];
                    $services->price = $results_query[0]['price'];
                    $services->action = $results_query[0]['action'];
                    $services->type = $results_query[0]['type'];
                    $services->taxation = $results_query[0]['taxation'];
                    $services->plan = $service_plan;
                    $services->cycle = $results_query[0]['cycle'];
                    $services->status = 1;
                    $query->save($services);

                    $this->Cookie->write('service_type', $service_type);
                    $this->Cookie->write('service_action', $service_action);
                    $this->Cookie->write('service_taxation', $service_taxation);
                    $this->Cookie->write('service_plan', $service_plan);

                    $result = array(
                        'status' =>  'ok'
                    );
                }

            }

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // STEP 2

    public function businessAddStep3()
    {

        if ($this->request->is('post')) {

            $date_now = Time::now();

            $user_id = $this->Cookie->read('user_id');
            $service_type = $this->Cookie->read('service_type');
            $service_action = $this->Cookie->read('service_action');
            $service_taxation = $this->Cookie->read('service_taxation');
            $business_id = $this->Cookie->read('business_id');

            // Atualiza Quotation
            $query = TableRegistry::get('Business');
            $query_business = $query->query();
            $query_business->update()
                ->set([
                    'zipcode' => $this->request->data['zipcode'],
                    'address' => $this->request->data['address'],
                    'number' => $this->request->data['number'],
                    'complement' => $this->request->data['complement'],
                    'district' => $this->request->data['district'],
                    'city' => $this->request->data['city'],
                    'state' => $this->request->data['state'],
                    'steps' => 3,
                    'updated' => $date_now
                ])
                ->where(['id' => $business_id])
                ->execute();

            // Buscar registros
            $query = TableRegistry::get('BusinessCategories');
            $query_users = $query
                    ->find()
                    ->where([
                        'business_id =' => $business_id
                    ]);

            if($query_users->isEmpty()){

                // Buscar registros
                $query = TableRegistry::get('CategoriesDefault');
                $query_categories_default = $query
                        ->find();

                foreach ($query_categories_default as $category_default) {

                    $query = TableRegistry::get('BusinessCategories'); 
                    $categories = $query->newEntity(); 
                    $categories->business_id =  $business_id;
                    $categories->type = $category_default->type;
                    $categories->group_categories = $category_default->group_categories;
                    $categories->name = $category_default->name;
                    $categories->created = $date_now; 
                    $query->save($categories);
                }
            }         

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // SIGN
    // CONTRACT

    public function businessAddStep5()
    {

        if ($this->request->is('post')) {

            $date_now = Time::now();
            $user_id = $this->Cookie->read('user_id');
            $business_id = $this->Cookie->read('business_id');
            $service_type = $this->Cookie->read('service_type');
            $service_action = $this->Cookie->read('service_action');
            $service_taxation = $this->Cookie->read('service_taxation');

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users = $query
                    ->find()
                    ->where([
                        'id =' => $user_id
                    ]);

            foreach ($query_users as $user) {
            }

            // Buscar registros
            $query = TableRegistry::get('Business');
            $query_business = $query
                    ->find()
                    ->where([
                        'id =' => $business_id
                    ]);

            foreach ($query_business as $business) {
            }

            // // Buscar registros
            // $query = TableRegistry::get('Payments');
            // $query_payments = $query
            //         ->find()
            //         ->where([
            //             'business_id =' => $business_id
            //         ]);

            // foreach ($query_payments as $payment) {
            //     $payment_type = $payment->type;
            // }

            // if($payment_type == "credit"){

            //     $payment_credit_number = $this->request->data['number'];
            //     $payment_credit_name = $this->request->data['name'];
            //     $payment_credit_maturity = $this->request->data['maturity'];
            //     $payment_credit_security = $this->request->data['security'];

            //     $phone = $user->phone;
            //     $phone = str_replace("(", "", $phone);
            //     $phone = str_replace(")", "", $phone);
            //     $phone = str_replace("-", "", $phone);
            //     $phone = str_replace(" ", "", $phone);
            //     $phone = substr($phone, 2, 99);
            //     $phone_prefix = substr($phone, 0, 2);

            //     $cpf = $user->cpf;
            //     $cpf = str_replace(".", "", $cpf);
            //     $cpf = str_replace("-", "", $cpf);

            //     $due_date = date_format($payment->maturity, "Y-m-d");


            //     // Atualiza Quotation
            //     $query = TableRegistry::get('Payments');
            //     $query_payments = $query->query();
            //     $query_payments->update()
            //         ->set([
            //             'credit_number' => $payment_credit_number,
            //             'credit_name' => $payment_credit_name,
            //             'credit_maturity' => $payment_credit_maturity,
            //             'credit_security' => $payment_credit_security
            //         ])
            //         ->where(['business_id' => $business_id])
            //         ->execute();
            // }

            // Atualiza Quotation
            $query = TableRegistry::get('Business');
            $query_users = $query->query();
            $query_users->update()
                ->set([
                    'steps' => 5,
                    'status' => "1"
                ])
                ->where(['id' => $business_id])
                ->execute();

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users = $query
                    ->find()
                    ->where([
                        'id =' => $user_id
                    ]);

            foreach ($query_users as $user) {
                $user_name = $user->name;
                $user_token = $user->token;
            }

            // Atualiza Quotation

            if($service_action == "abertura"){
                $status_action = 2;
            }else{
                $status_action = 3;
            }

            $query = TableRegistry::get('Business');
            $query_business = $query->query();
            $query_business->update()
                ->set([
                    'status' => $status_action
                ])
                ->where(['id' => $business_id])
                ->execute();

            // Envia e-mail de Confirmação de e-mail
            $email = new Email();
            $email->viewVars(['id' => $user_id]);
            $email->viewVars(['name' => $user_name]);
            $email->viewVars(['token' => $user_token]);
            $email->template('welcome')
            ->subject('Seja bem vindo a Link')
            ->emailFormat('html')
            ->to($user->username)
            ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // SIGN
    // CONTRACT

    public function businessUpdateSign()
    {

        if ($this->request->is('post')) {

            $date_now = Time::now();
            $user_id = $this->Cookie->read('user_id');
            $business_id = $this->Cookie->read('business_id');

            // Atualiza Quotation
            $query = TableRegistry::get('Business');
            $query_business = $query->query();
            $query_business->update()
                ->set([
                    'sign' => 1,
                    'steps' => 4,
                    'sign_date' => $date_now
                ])
                ->where(['id' => $business_id])
                ->execute();

            // CLICKSIGN

            // TOKEN
            // 8cb889e9-38c4-4dde-925d-5dd607331d86

            // // Buscar registros
            // $query = TableRegistry::get('Users');
            // $query_users = $query
            //         ->find()
            //         ->where([
            //             'id =' => $user_id
            //         ]);

            // foreach ($query_users as $user) {
            //     $user_id = $user->id;
            //     $user_name = $user->name;
            //     $user_lastname = $user->lastname;
            //     $user_username = $user->username;
            //     $user_cpf = $user->cpf;
            //     $user_birthday = $user->birthday;
            //     $user_phone = $user->phone;
            //     $user_whatsapp = $user->whatsapp;
            // }

            // $query = [];
            
            // $query['signer'] = [
            //     "email" => $user_username,
            //     "phone_number" => $user_whatsapp,
            //     "auths" => ["email"],
            //     "name" => $user_name." ".$user_lastname,
            //     "documentation" => $user_cpf,
            //     "birthday" => $user_birthday,
            //     "has_documentation" => true,
            //     "delivery" => "email"
            // ];
            
            // $url = 'https://app.clicksign.com/api/v1/signers?access_token=8cb889e9-38c4-4dde-925d-5dd607331d86';
            // $query = json_encode($query);
            
            // $curl = curl_init($url);
            // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            //     'Content-Type: application/json',
            //     'Host: sandbox.clicksign.com',
            //     'Content-Length: ' . strlen($query))
            // );
            // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($curl, CURLOPT_POST, true);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
            // $xml = json_decode(curl_exec($curl));
            
            // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            // curl_close($curl);
            
            // $key_user = $xml->signer->key;
            // print_r($xml);

            // // CRIAR DOCUMENTO




            // // DOCUMENTO em BASE 64
            // $document_64 = '';
            




            // $query = [];
            
            // $query['document'] = [
            //     "path" => '/Contratos Site/Contrato-Link-Contabilidade-Consultiva#'.$user_id.'.pdf',
            //     "content_base64" => $document_64,
            //     "locale" => "pt-BR"
            // ];
            
            // $url = 'https://app.clicksign.com/api/v1/documents?access_token=8cb889e9-38c4-4dde-925d-5dd607331d86';
            // $query = json_encode($query);
            
            // $curl = curl_init($url);
            // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            //     'Content-Type: application/json',
            //     'Host: sandbox.clicksign.com',
            //     'Content-Length: ' . strlen($query))
            // );
            // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($curl, CURLOPT_POST, true);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
            // $xml = json_decode(curl_exec($curl));
            
            // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            // curl_close($curl);
            
            // $key_document = $xml->document->key;
            // // print_r($xml);
            
            // // LINK USER DOCUMENT
            // $query = [];
            
            // $query['list'] = [
            //     "document_key" => $key_document,
            //     "signer_key" => $key_user,
            //     "sign_as" => "contractor"
            // ];
            
            // $url = 'https://app.clicksign.com/api/v1/lists?access_token=8cb889e9-38c4-4dde-925d-5dd607331d86';
            // $query = json_encode($query);
            
            // $curl = curl_init($url);
            // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            //     'Content-Type: application/json',
            //     'Host: sandbox.clicksign.com',
            //     'Content-Length: ' . strlen($query))
            // );
            // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($curl, CURLOPT_POST, true);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
            // $xml = json_decode(curl_exec($curl));
            
            // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            // curl_close($curl);
            
            // $key_request = $xml->list->request_signature_key;
            // // print_r($xml);
            
            // // SEND EMAIL
            // $query = [];
            
            // $query = [
            //     "request_signature_key" => $key_request,
            //     "message" => "Assine o seu contrato de Prestação de Serviços da Link Contabilidade Consultiva",
            // ];
            
            // $url = 'https://app.clicksign.com/api/v1/notifications?access_token=8cb889e9-38c4-4dde-925d-5dd607331d86';
            // $query = json_encode($query);
            
            // $curl = curl_init($url);
            // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            //     'Content-Type: application/json',
            //     'Host: sandbox.clicksign.com',
            //     'Content-Length: ' . strlen($query))
            // );
            // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($curl, CURLOPT_POST, true);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $query);
            // $xml = json_decode(curl_exec($curl));
            
            // $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            // curl_close($curl);

            // $key_request = $xml->list->request_signature_key;
            // print_r($xml);
            // die();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // SIGN
    // CONTRACT

    public function businessUpdateTerms()
    {

        if ($this->request->is('post')) {

            $date_now = Time::now();
            $user_id = $this->Cookie->read('user_id');
            $business_id = $this->Cookie->read('business_id');

            // Atualiza Quotation
            $query = TableRegistry::get('Business');
            $query_business = $query->query();
            $query_business->update()
                ->set([
                    'terms' => 1,
                    'steps' => 4,
                    'terms_date' => $date_now
                ])
                ->where(['id' => $business_id])
                ->execute();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // SIGN
    // CONTRACT

    public function paymentsAddBillet()
    {     
        if ($this->request->is('post')) {

            $date_now = Time::now();

            $business_id = $this->Cookie->read('business_id');
            $user_id = $this->Cookie->read('user_id');

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users = $query
                    ->find()
                    ->where([
                        'id =' => $user_id
                    ]);

            foreach ($query_users as $user) {
            }

            // Buscar registros
            $query = TableRegistry::get('Business');
            $query_business = $query
                    ->find()
                    ->where([
                        'id =' => $business_id
                    ]);

            foreach ($query_business as $business) {
            }

            // Buscar registros
            $query = TableRegistry::get('Payments');
            $query_payments = $query
                    ->find()
                    ->where([
                        'business_id =' => $business_id
                    ]);

            foreach ($query_payments as $payment) {
                $payment_codebar = $payment->billet_codebar;
            }

            if($payment_codebar == ""){

                // INTEGRAÇÃO GERENCIANET

                // Dados
                $mensalidade = number_format($payment->amount, 2, '.', '');
                $mensalidade = str_replace(".","",$mensalidade);

                $cpf = str_replace(".","",$business->cpf);
                $cpf = str_replace("-","",$cpf);
                settype($cpf, "string");

                $phone = str_replace("(","",$user->phone);
                $phone = str_replace(")","",$phone);
                $phone = str_replace("-","",$phone);
                $phone = str_replace(" ","",$phone);
                settype($phone, "string");

                $cnpj = str_replace(".","",$business->cnpj);
                $cnpj = str_replace("-","",$cnpj);
                $cnpj = str_replace("/","",$cnpj);

                // Payment Desenvolvimento
                // $clientId = 'Client_Id_e29f9661f9db42370ec476b8b8cf4a66f29521ca';
                // $clientSecret = 'Client_Secret_59f50249d1e261d62f0c4d1484e55581abc0a861';
                // $sandbox_active = true;

                // // Payment Produção
                $clientId = 'Client_Id_d751f7214dcccea322d43684a97888dec278b82c';
                $clientSecret = 'Client_Secret_dd65f3a77add7f5a6d4e7a0d0e31cf68ffb7bb41';
                $sandbox_active = false;

                $options = [
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'sandbox' => $sandbox_active // altere conforme o ambiente (true = desenvolvimento e false = producao)
                ];

                $item_1 = [
                    'name' => 'Link Contabilidade Consultiva', // nome do item, produto ou serviço
                    'amount' => 1, // quantidade
                    'value' => intval($mensalidade) // valor (1000 = R$ 10,00)
                ];

                $items =  [
                    $item_1
                ];

                //Exemplo para receber notificações da alteração do status da transação.
                //Outros detalhes em: https://dev.gerencianet.com.br/docs/notificacoes
                $metadata = ['notification_url'=>'https://www.linkcontabilidade.com.br/api/automate/gerencianet'];
                
                $body  =  [
                    'items' => $items
                ];
                  
                
                try {
                    $api = new Gerencianet($options);
                    $charge = $api->createCharge([], $body);
                    // print_r($charge);
                } catch (GerencianetException $e) {
                    // print_r($e->code);
                    // print_r($e->error);
                    // print_r($e->errorDescription);
                } catch (Exception $e) {
                    // print_r($e->getMessage());
                }

                // $charge_id refere-se ao ID da transação gerada anteriormente
                $charge_id = $charge['data']['charge_id'];

                $params = [
                    'id' => $charge_id
                ];

                if($business->action == "migracao"){

                    $juridical_data = [
                        'corporate_name' => $business->razao, // nome da razão social
                        'cnpj' => $cnpj // CNPJ da empresa, com 14 caracteres
                    ];

                    $customer = [
                        'name' => $user->name." ".$user->lastname,
                        'cpf' => $cpf,
                        'email' => $user->username,
                        'phone_number' => $phone,
                        'juridical_person' => $juridical_data
                    ];

                }else{

                    $customer = [
                        'name' => $user->name." ".$user->lastname,
                        'cpf' => $cpf,
                        'email' => $user->username,
                        'phone_number' => $phone
                    ];
                }

                // print_r($customer);
                // die();

                $bankingBillet = [
                    'expire_at' => date('Y-m-d', strtotime('+1 days', strtotime($date_now))), // data de vencimento do boleto (formato: YYYY-MM-DD)
                    'customer' => $customer,
                    'message' => "Contratação da Link Contabilidade Consultiva"
                ];
                
                $payment = [
                    'banking_billet' => $bankingBillet // forma de pagamento (banking_billet = boleto)
                ];

                $body = [
                    'payment' => $payment
                ];
                try {
                    $api = new Gerencianet($options);
                    $charge = $api->payCharge($params, $body);

                    // print_r($charge);
                } catch (GerencianetException $e) {
                    // print_r($e->code);
                    // print_r($e->error);
                    // print_r($e->errorDescription);
                } catch (Exception $e) {
                    // print_r($e->getMessage());
                }

                // $date_expire = Date::now();
                // $date_expire = date_format($payment->maturity, "d-m-Y");
                // $id_signature = "123456789";
                // $secure_url = "link";

                $id_signature = $charge_id;
                $date_expire = $charge['data']['expire_at'];
                $barcode = $charge['data']['barcode'];
                $secure_url = $charge['data']['link'];

                // Atualiza Quotation
                $query = TableRegistry::get('Payments');
                $query_payments = $query->query();
                $query_payments->update()
                    ->set([
                        'billet_id' => $id_signature,
                        'billet_codebar' => $barcode,
                        'billet_link' => $secure_url,
                        'billet_maturity' => $date_expire,
                        'type' => "billet"
                    ])
                    ->where(['business_id' => $business_id])
                    ->execute();

            }else{

                // Atualiza Quotation
                $query = TableRegistry::get('Payments');
                $query_payments = $query->query();
                $query_payments->update()
                    ->set([
                        'type' => "billet"
                    ])
                    ->where(['business_id' => $business_id])
                    ->execute();
            }

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // SIGN
    // CONTRACT

    public function paymentsAddCredit()
    {

        if ($this->request->is('post')) {

            $business_id = $this->Cookie->read('business_id');
            $user_id = $this->Cookie->read('user_id');

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users = $query
                    ->find()
                    ->where([
                        'id =' => $user_id
                    ]);

            foreach ($query_users as $user) {
                $user_token = $user->token;
                $client_name = $user->name." ".$user->lastname;
                $client_cpf = $user->cpf;
                $client_phone = $user->phone;
                $client_email = $user->username;
                $client_birth = $user->birthday;
            }

            $data_business = TableRegistry::get('Business');
            $query_business = $data_business
                    ->find()
                    ->where([
                        'id =' => $business_id
                    ]);

            foreach ($query_business as $business) {
                $client_street = $business->address;
                $client_number = $business->number;
                $client_district = $business->district;
                $client_zipcode = $business->zipcode;
                $client_zipcode =str_replace(".","",$client_zipcode);
                $client_zipcode =str_replace("-","",$client_zipcode);
                $client_city = $business->city; 
                $client_state = $business->state; 
            }

            $query = TableRegistry::get('Payments');
            $query_payments = $query
                    ->find()
                    ->where([
                        'business_id =' => $business_id
                    ]);

            foreach ($query_payments as $payment) {
            }

            $mensalidade = number_format($payment->amount, 2, '.', '');
            $mensalidade = str_replace(".","",$mensalidade);

            $cpf = str_replace(".","",$business->cpf);
            $cpf = str_replace("-","",$cpf);
            settype($cpf, "string");

            $phone = str_replace("(","",$user->phone);
            $phone = str_replace(")","",$phone);
            $phone = str_replace("-","",$phone);
            $phone = str_replace(" ","",$phone);
            settype($phone, "string");

            $cnpj = str_replace(".","",$business->cnpj);
            $cnpj = str_replace("-","",$cnpj);
            $cnpj = str_replace("/","",$cnpj);

            // 20/20/2020
            $client_birth = substr($client_birth, 6, 4).'-'.substr($client_birth, 3, 2).'-'.substr($client_birth, 0, 2);
            
            // GERENCIANET
            $paymentToken = $_POST['paymentId'];

            // Payment Desenvolvimento
            // $clientId = 'Client_Id_e29f9661f9db42370ec476b8b8cf4a66f29521ca';
            // $clientSecret = 'Client_Secret_59f50249d1e261d62f0c4d1484e55581abc0a861';
            // $sandbox_active = true;

            // // Payment Produção
            $clientId = 'Client_Id_d751f7214dcccea322d43684a97888dec278b82c';
            $clientSecret = 'Client_Secret_dd65f3a77add7f5a6d4e7a0d0e31cf68ffb7bb41';
            $sandbox_active = false;

            $options = [
                'client_id' => $clientId,
                'client_secret' => $clientSecret,
                'sandbox' => $sandbox_active // altere conforme o ambiente (true = desenvolvimento e false = producao)
            ];

            $item_1 = [
                'name' => 'Link Contabilidade Consultiva', // nome do item, produto ou serviço
                'amount' => 1, // quantidade
                'value' => intval($mensalidade) // valor (1000 = R$ 10,00)
            ];

            $items =  [
                $item_1
            ];

            //Exemplo para receber notificações da alteração do status da transação.
            //Outros detalhes em: https://dev.gerencianet.com.br/docs/notificacoes
            $metadata = ['notification_url'=>'https://www.linkcontabilidade.com.br/api/automate/gerencianet'];
            
            $body  =  [
                'items' => $items
            ];
              
            
            try {
                $api = new Gerencianet($options);
                $charge = $api->createCharge([], $body);
                // print_r($charge);
            } catch (GerencianetException $e) {
                // print_r($e->code);
                // print_r($e->error);
                // print_r($e->errorDescription);
            } catch (Exception $e) {
                // print_r($e->getMessage());
            }

            // $charge_id refere-se ao ID da transação gerada anteriormente
            $charge_id = $charge['data']['charge_id'];

            $params = [
                'id' => $charge_id
            ];

            $customer = [
            
                // 'name' => 'Lilian Mieko Tobace',
                // 'cpf' => '47017471814',
                // 'phone_number' => '16981381552',
                // 'email' => 'liliantobace@yahoo.com.br',
                // 'birth' => '1997-10-23'
            
                'name' => $client_name,
                'cpf' => $cpf,
                'phone_number' => $phone,
                'email' => $client_email,
                'birth' => $client_birth
            ];

            $billingAddress = [
                // 'street' => 'Rua alvaro alvim',
                // 'number' => 375 ,
                // 'neighborhood' => 'vila paulista',
                // 'zipcode' => '12460000' ,
                // 'city' => 'Campos do Jordão',
                // 'state' => 'SP'      
                'street' => $client_street,
                'number' => $client_number ,
                'neighborhood' => $client_district,
                'zipcode' => $client_zipcode,
                'city' => $client_city,
                'state' => $client_state      
            ];

            // $discount = [
            //     'type' => 'currency',
            //     'value' => 200
            // ];

            // $configurations = [
            //     'fine' => 200,
            //     'interest' => 33
            // ];

            $credit_card = [
                'customer' => $customer,
                'installments' => 1,
                // 'discount' => $discount,
                'billing_address' => $billingAddress,
                'payment_token' => $paymentToken
            ];

            $payment = [
                'credit_card' => $credit_card
            ];

            $body = [
                // 'items' => $items,
                // 'metadata' => $metadata,
                'payment' => $payment
            ];

            try {
                $api = new Gerencianet($options);
                $charge = $api->payCharge($params, $body);
                // $pay_charge = $api->createCharge([],$body);
                // $pay_charge = $api->oneStep([],$body);
                // echo '<pre>';
                // print_r($charge);
                // echo '<pre>';
            } catch (GerencianetException $e) {
                // print_r($e->code);
                // print_r($e->error);
                // print_r($e->errorDescription);
            } catch (Exception $e) {
                // print_r($e->getMessage());
            }

            // Atualiza Quotation
            $query = TableRegistry::get('Payments');
            $query_payments = $query->query();
            $query_payments->update()
                ->set([
                    'credit_id' => $charge_id,
                    'type' => "credit",
                    'status' => 2
                ])
                ->where(['business_id' => $business_id])
                ->execute();

            // $email = new Email();
            // $email->viewVars(['id' => $user_id]);
            // $email->viewVars(['name' => $client_name]);
            // $email->viewVars(['token' => $user_token]);
            // $email->template('welcome')
            // ->subject('Seja bem vindo a Link')
            // ->emailFormat('html')
            // ->to($client_email)
            // ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            // ->send();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    public function paymentsTransfer()
    {

        if ($this->request->is('post')) {

            $business_id = $this->Cookie->read('business_id');
            $user_id = $this->Cookie->read('user_id');

            // Buscar registros
            $query = TableRegistry::get('Users');
            $query_users = $query
                    ->find()
                    ->where([
                        'id =' => $user_id
                    ]);

            foreach ($query_users as $user) {
                $user_token = $user->token;
                $client_name = $user->name;
                $client_email = $user->username;
            }

            // Atualiza Quotation
            $query = TableRegistry::get('Payments');
            $query_payments = $query->query();
            $query_payments->update()
                ->set([
                    'type' => "transfer"
                ])
                ->where(['business_id' => $business_id])
                ->execute();

            // $email = new Email();
            // $email->viewVars(['id' => $user_id]);
            // $email->viewVars(['name' => $client_name]);
            // $email->viewVars(['token' => $user_token]);
            // $email->template('welcome')
            // ->subject('Seja bem vindo a Link')
            // ->emailFormat('html')
            // ->to($client_email)
            // ->from('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            // ->send();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }


    // SEARCH
    // CEP

    public function searchCep()
    {

        if ($this->request->is('post')) {

            $cep = $this->request->data['zipcode'];
            $cep = str_replace("-", "", $cep);

            ini_set('default_socket_timeout', 10);
            $retorno = file_get_contents("https://viacep.com.br/ws/".$cep."/json/", true);
            $resultado = json_decode($retorno, true);

            $result = array(
                'status' => 'ok',
                'address' => $resultado['logradouro'],
                'district' => $resultado['bairro'],
                'city' => $resultado['localidade'],
                'state' => $resultado['uf']
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    // CONTACT
    // SEND

    public function sendContact()
    {

        if ($this->request->is('post')) {

            $date_now = Time::now();

            // Envia e-mail para contato
            $email = new Email();
            // $email->ViewVars(['name' => $this->request->data('name')]);
            // $email->ViewVars(['email' => $this->request->data('email')]);
            // $email->ViewVars(['phone' => $this->request->data('phone')]);
            // $email->ViewVars(['message' => $this->request->data('message')]);
            // $email->'name' = $this->request->data('name');
            // $email->'email' = $this->request->data('email');
            // $email->'phone' = $this->request->data('phone');
            // $email->'message' = $this->request->data('message');
            // $email->'date' = date_format($date_now, 'd-m-Y')." às ".date_format($date_now, 'H:i');
            $email->Template('contact')
            ->Subject($this->request->data('name').' acabou de entrar em contato!')
            ->EmailFormat('html')
            ->To('contato@linkcontabilidade.com.br')
            // ->To('webmaster@oceaning.com.br')
            // ->To('liliantobace@yahoo.com.br')
            ->From('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();

            $result = array(
                'status' => 'ok',
                'message' => 'Em breve nossa equipe entrará em contato com você!'
            );

            $this->set(compact('result'));
        }
    }

    public function searchCnpj()
    {
        $date_now = Time::now();

        $business_id = $this->Cookie->read('business_id');
        $user_id = $this->Cookie->read('user_id');
        $service_type = $this->Cookie->read('service_type');
        $service_action = $this->Cookie->read('service_action');
        $service_taxation = $this->Cookie->read('service_taxation');
        $service_plan = $this->Cookie->read('service_plan');

        if ($this->request->is('post')) {
            
            $query = TableRegistry::get('Users');
            $query_users = $query
                    ->find()
                    ->where([
                        'id =' => $user_id
                    ]);

            foreach ($query_users as $user) {
                $user_cpf = $user->cpf;
            }

            $query = TableRegistry::get('Services');
            $query_services = $query
                    ->find()
                    ->where([
                        'type =' => $service_type,
                        'action =' => $service_action,
                        'taxation =' => $service_taxation,
                        'plan =' => $service_plan
                    ]);

            foreach ($query_services as $service) {
                $service_id = $service->id;
            }

            $cnpj = $this->request->data['cnpj'];
            $cnpj = str_replace(".","",$cnpj);
            $cnpj = str_replace("-","",$cnpj);
            $cnpj = str_replace("/","",$cnpj);

            $curl_handle=curl_init();
            curl_setopt($curl_handle, CURLOPT_URL,"https://www.receitaws.com.br/v1/cnpj/".$cnpj);
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($curl_handle, CURLOPT_TIMEOUT, 5);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Link Contabilidade');
            $query = curl_exec($curl_handle);
            $resultado = json_decode($query, true);
            curl_close($curl_handle);

            if(isset($resultado['status'])){

                if($resultado['status'] != "ERROR"){
                    
                    if(!isset($business_id)){
                        $query = TableRegistry::get('Business');
                        $business = $query->newEntity();
                        $business->razao = $resultado['nome'];
                        $business->fantasia = $resultado['fantasia'];
                        $business->cnpj = $this->request->data['cnpj'];
                        $business->cpf = $user_cpf;
                        $business->action = $service_action;
                        $business->type = $service_type;
                        $business->taxation = $service_taxation;
                        $business->faturamento = 0;
                        $business->socios = 1;
                        $business->funcionarios = 0;
                        $business->sign = 0;
                        $business->sign_date = "";
                        $business->steps = 2;
                        $business->terms = 0;
                        $business->terms_date = "";
                        $business->zipcode = $resultado['cep'];
                        $business->address = $resultado['logradouro'];
                        $business->number = $resultado['numero'];
                        $business->complement = $resultado['complemento'];
                        $business->district = $resultado['bairro'];
                        $business->city = $resultado['municipio'];
                        $business->state = $resultado['uf'];
                        $business->created = $date_now;
                        $business->updated = $date_now;
                        $business->status = 1;
                        $query->save($business);
    
                        // Cria nova Quotations
                        $query = TableRegistry::get('AccessBusiness');
                        $access = $query->newEntity();
                        $access->user_id = $user_id;
                        $access->business_id = $business->id;
                        $access->status = 1;
                        $query->save($access);
        
                        // Cria nova Quotations
                        $query = TableRegistry::get('ServicesBusiness');
                        $services = $query->newEntity();
                        $services->business_id = $business->id;
                        $services->service_id = $service_id;
                        $services->status = 1;
                        $query->save($services);
        
                        // Cria nova Quotations
                        $query = TableRegistry::get('Payments');
                        $payments = $query->newEntity();
                        $payments->business_id = $business->id;
                        $payments->type = "none";
                        $payments->amount = 0;
                        $payments->maturity = $date_now;
                        $payments->status = 1;
                        $query->save($payments);
        
                        $this->Cookie->write('business_id', $business->id);

                            $result = array(
                                'status' => 'ok',
                                'razao' => $resultado['nome'],
                                'fantasia' => $resultado['fantasia'],
                                'principal' => $resultado['atividade_principal'],
                                'secundarias' => $resultado['atividades_secundarias'],
                                'admin' => $resultado['qsa']
                                // 'numero' => $resultado['numero'],
                                // 'complemento' => $resultado['complemento'],
                                // 'bairro' => $resultado['bairro'],
                                // 'cidade' => $resultado['municipio'],
                                // 'estado' => $resultado['uf']
                            );
                    }else{

                        $query = TableRegistry::get('Business');
                        $query_business = $query->query();
                        $query_business->update()
                            ->set([
                                'razao' =>  $resultado['nome'],
                                'fantasia' => $resultado['fantasia'],
                                'cnpj' => $this->request->data['cnpj'],
                                'zipcode' => $resultado['cep'],
                                'address' => $resultado['logradouro'],
                                'number' => $resultado['numero'],
                                'complement' => $resultado['complemento'],
                                'district' => $resultado['bairro'],
                                'city' => $resultado['municipio'],
                                'state' => $resultado['uf'],
                                'steps' => 2,
                                'updated' => $date_now
                            ])
                            ->where(['id' => $business_id])
                            ->execute();

                        
                        $result = array(
                            'status' => 'ok',
                            'razao' => $resultado['nome'],
                            'fantasia' => $resultado['fantasia'],
                            'principal' => $resultado['atividade_principal'],
                            'secundarias' => $resultado['atividades_secundarias'],
                            'admin' => $resultado['qsa']
                        );

                    }
                }else{
                    $result = array(
                        'status' => 'CNPJ inválido!'
                    );
                }

            }else{
                $result = array(
                    'status' => 'error'
                );
            }

            $this->set(compact('result'));
        }

    }

    public function agendarLucroReal()
    {

        if ($this->request->is('post')) {

            // $date_now = Time::now();
            $user_id = $this->Cookie->read('user_id');
            
            $query = TableRegistry::get('Users');
            $query_users = $query
                    ->find()
                    ->where([
                        'id =' => $user_id
                    ]);

            foreach ($query_users as $user) {
                $user_name = $user->name;
                $user_lastname = $user->name;
                $user_email = $user->username;
                $user_phone = $user->phone;
            }

            // Envia e-mail de Confirmação de e-mail
            $email = new Email();
            $email->ViewVars(['name' => $user_name.' '.$user_lastname]);
            $email->ViewVars(['email' => $user_email]);
            $email->ViewVars(['phone' => $user_phone]);
            $email->ViewVars(['cnpj' => $this->request->data('lucro_real_cnpj')]);
            $email->ViewVars(['tributacao' => $this->request->data('lucro_real_tributacao')]);
            $email->ViewVars(['socios' => $this->request->data('lucro_real_socios')]);
            $email->ViewVars(['funcionarios' => $this->request->data('lucro_real_funcionarios')]);
            $email->ViewVars(['faturamento' => $this->request->data('lucro_real_faturamento')]);
            $email->ViewVars(['filial' => $this->request->data('lucro_real_filial')]);
            $email->ViewVars(['exportacao' => $this->request->data('lucro_real_exportacao')]);
            $email->ViewVars(['gestao' => $this->request->data('lucro_real_gestao')]);
            $email->Template('agendar_lucro_real')
            ->Subject($user_name.' '.$user_lastname.' acabou de agendar precificação do lucro rea!')
            ->EmailFormat('html')
            ->To('contato@linkcontabilidade.com.br')
            // ->To('liliantobace@yahoo.com.br')
            ->From('contato@linkcontabilidade.com.br', 'Link Contabilidade')
            ->send();

            $result = array(
                'status' => 'ok'
            );

        }else{
            $result = array(
                'status' => 'error-post'
            );
        }

        $this->set(compact('result'));
    }

    /**
     * All Citys
     */
    public function searchCitys()
    {

        if ($this->request->is('post')) {

            if(isset($this->request->data['answer_23'])){
                $uf = $this->request->data['answer_23'];
            }else{
                $uf = $this->request->data['answer_52'];
            }

            // Busca Activity
            $citys = TableRegistry::get('Citys');
            $query_citys = $citys
                ->find()
                ->where([
                    'uf =' => $uf
                ]);

            $result = array(
                'status' => 'ok',
                'citys' => $query_citys
            );

            $this->set(compact('result'));
        }
    }

    /**
     * All Citys
     */
    public function searchAbertura()
    {

        if ($this->request->is('post')) {

            $uf = $this->request->data['answer_23'];
            $city = $this->request->data['answer_22'];
            $socios = $this->request->data['abertura-socios'];

            // Busca Activity
            $citys = TableRegistry::get('Citys');
            $query_citys = $citys
                ->find()
                ->where([
                    'uf =' => $uf
                ]);

            // Taxas
            foreach ($query_citys as $citys) {

                if($citys->id == $city){

                    if($socios > 1){
                        $receita = $citys->socio_juntareceita;
                        $prefeitura = $citys->socio_prefeitura;
                    }else{
                        $receita = $citys->indiv_juntareceita;
                        $prefeitura = $citys->indiv_prefeitura;
                    }
                }
            }

            $result = array(
                'status' => 'ok',
                'receita' => $receita,
                'prefeitura' => $prefeitura
            );

            $this->set(compact('result'));
        }
    }

}