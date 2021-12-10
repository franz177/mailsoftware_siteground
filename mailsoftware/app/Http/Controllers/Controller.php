<?php

namespace App\Http\Controllers;

use App\Models\Typo;
use App\Models\TypoCountry;
use App\Models\TypoHouses;
use App\Models\TypoSite;
use App\Models\TypoUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getHouses()
    {
        $typo_h = new TypoHouses;
        $houses = TypoHouses::select(['uid', TypoHouses::raw('CONCAT(subheader, \' \', header) as name')])
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->get();

        return $houses;
    }

    protected function getTypoHouse($uid)
    {
        $typo_h = new TypoHouses;
        $house = TypoHouses::select('subheader')
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->where('uid', '=', $uid)
            ->first();

        return $house->subheader;
    }

    protected function getHouseGestoreArray()
    {
        $typo_h = new TypoHouses;
        $houses_gestore = TypoHouses::select('uid', 'tx_mask_t1_casa_gestore')
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->pluck('tx_mask_t1_casa_gestore','uid');

        return $houses_gestore;
    }

    protected function getHousesAbbrArray()
    {
        $typo_h = new TypoHouses;
        $houses = TypoHouses::select('uid', 'subheader')
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->orderBy('uid')
            ->pluck('subheader', 'uid');

        return $houses;
    }

    protected function getHousesArray()
    {
        $typo_h = new TypoHouses;
        $houses = TypoHouses::select(['uid', TypoHouses::raw('CONCAT(header,\' \', subheader) as name')])
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->orderBy('uid')
            ->pluck('name', 'uid');

        return $houses;
    }

    protected function getHousesAbbArray()
    {
        $typo_h = new TypoHouses;
        $houses = TypoHouses::select('uid', 'subheader as name')
            ->where('CType', $typo_h->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->whereIn('uid', array(1,3,4,5,6,7,8))
            ->orderBy('uid')
            ->pluck('name', 'uid');

        return $houses;
    }

    protected function getSites()
    {
        $typo_s = new TypoSite;
        $sites = TypoSite::select(['uid', 'header', 'tx_mask_siti_abbr as sito', 'tx_mask_siti_perc as percentuale'])
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->orderBy('header')
            ->get();

        return $sites;
    }

    protected function getSitesByKross($siteKross)
    {
        $typo_s = new TypoSite;
        $site = TypoSite::select('uid', 'header')
            ->where('CType', $typo_s->CType)
            ->where('tx_mask_siti_kross_cod_channel', '=', $siteKross)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->first();

        return $site;
    }

    protected function getSitesKross()
    {
        $typo_s = new TypoSite;
        $site = TypoSite::select('tx_mask_siti_kross_cod_channel', 'tx_mask_siti_abbr')
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->pluck('tx_mask_siti_abbr','tx_mask_siti_kross_cod_channel');

        return $site;
    }

    protected function getSitesArray()
    {
        $typo_s = new TypoSite;
        $sites = TypoSite::select(['uid', 'tx_mask_siti_abbr as sito'])
            ->where('CType', $typo_s->CType)
            ->where('hidden', '=', 0)
            ->where('deleted', '=', 0)
            ->orderBy('uid')
            ->pluck('sito', 'uid');

        return $sites;
    }

    protected function getUsers()
    {
        $users = TypoUser::join('fe_groups', 'fe_users.usergroup', '=', 'fe_groups.uid')
            ->select(['fe_users.uid', 'fe_groups.uid as uidg', 'fe_users.name', 'fe_users.telephone', 'fe_users.tx_nv_ag_cod_op_excel as excel', TypoUser::raw('CONCAT(fe_users.first_name, \' \', fe_users.last_name) as nominativo'), 'fe_groups.title', 'fe_users.usergroup'])
            ->where('fe_users.disable', '=', 0)
            ->where('fe_users.deleted', '=', 0)
            ->where('fe_users.pid', '=', 4)
            ->orderBy('fe_groups.uid')
            ->get();

        return $users;
    }

    protected function getUsersArray()
    {
        $users = TypoUser::join('fe_groups', 'fe_users.usergroup', '=', 'fe_groups.uid')
            ->select(['fe_users.uid', 'fe_groups.uid as uidg', 'fe_users.name', 'fe_users.telephone', 'fe_users.tx_nv_ag_cod_op_excel as excel', TypoUser::raw('CONCAT(fe_users.first_name, \' \', fe_users.last_name) as nominativo'), 'fe_groups.title', 'fe_users.usergroup'])
            ->where('fe_users.disable', '=', 0)
            ->where('fe_users.deleted', '=', 0)
            ->where('fe_users.pid', '=', 4)
            ->orderBy('fe_groups.uid')
            ->pluck('fe_users.name', 'uid');

        return $users;
    }

    protected function getAllUsersArray()
    {
        $users = TypoUser::select('uid', 'name')
            ->where('disable', '=', 0)
            ->where('deleted', '=', 0)
            ->pluck('name', 'uid');

        return $users;
    }
    protected function getAllUsers()
    {
        $users = TypoUser::select('uid', 'name')
            ->pluck('name', 'uid');

        return $users;
    }

    protected function getCountriesArray($country_id)
    {
        $countries = TypoCountry::select('cn_short_it as name')
            ->where('deleted', '=', 0)
            ->where('uid','=',$country_id)
            ->first();

        return $countries;
    }

    // VISTE
    public function getYears(){
        return Typo::select(Typo::raw('YEAR(tx_mask_p_data_prenotazione) as year'))
            ->where('CType', '=', 'mask_db_alg_pren')
            ->where('tt_content.hidden', '=', 0)
            ->where('tt_content.deleted', '=', 0)
            ->whereNotNull('tx_mask_p_data_prenotazione')
            ->groupBy([Typo::raw('YEAR(tx_mask_p_data_prenotazione)')])
            ->orderBy('year', 'desc')
            ->get();
    }
}
