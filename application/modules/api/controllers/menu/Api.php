<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * Auth API
 * @author Pradeep Singh
 * @package Auth
 *
 */
class Api extends REST_Controller {
	
	/**
	 * Fuction For user Login
	 * @return json
	 */
	public function detail_get() {
		$this->load->library('zyk/SearchLib');
		$restid = $this->get('restid');
		$map = array();
		$map['restid'] = $restid;
		$map['latitude'] = $this->get('latitude');
		$map['longitude'] = $this->get('longitude');
		if(!empty($map['latitude']) && !empty($map['longitude']) && !empty($restid)) {
			$restaurant = $this->searchlib->getRestaurantDetails($map);
			if($restaurant[0]['has_deal'] == 1) {
				$this->load->library ( 'zyk/RestaurantOfferLib' );
				$restoffer = $this->restaurantofferlib->getActiveOfferByRestId ( $restid );
			} else {
				$restoffer = array();
			}
			$this->load->library('zyk/MenuLib');
			$items = $this->menulib->completemenu($restid);
			$newitems = array();
			foreach ($items as $mcat) {
				$category = array();
				$category['id'] = $mcat['id'];
				$category['description'] = $mcat['description'];
				$category['image'] = $mcat['image'];
				$category['sortorder'] = $mcat['sortorder'];
				$category['name'] = $mcat['name'];
				foreach ($mcat['categories'] as $cat) {
					$item = array();
					$item['id'] = $cat['id'];
					$item['description'] = $cat['description'];
					$item['sortorder'] = $cat['sortorder'];
					$item['image'] = $cat['image'];
					$item['name'] = $cat['name'];
					$item['menu_mcat_id'] = $cat['menu_mcat_id'];
					foreach ($cat['items'] as $oitem) {
						$sizes = array();
						foreach ($oitem as $value) {
							$sizes['id'] = $value['id'];
							$sizes['restid'] = $value['restid'];
							$sizes['name'] = $value['name'];
							$sizes['menu_cat_id'] = $value['menu_cat_id'];
							$sizes['description'] = $value['description'];
							$sizes['image'] = $value['image'];
							$sizes['sizes'][] = $value;
						}
						$item['items'][] = $sizes;
					}
					$category['categories'][] = $item;
				}
				$newitems[] = $category;
			}
			$response = array();
			$response['status'] = 1;
			if(count($restaurant) > 0)
				$response['restaurant'] = $restaurant[0];
			else 
				$response['restaurant'] = array();
			$response['offers'] = $restoffer;
			$response['menu'] = $newitems;
		} else {
			$response = array();
			$response['status'] = 0;
			if(empty($restid)) {
				$response['message'] = 'Restaurant ID is required.';
			} else {
				$response['message'] = 'Latitude and longitude required.';
			}
		}
		$this->response ( $response,200);
	}
	
	public function offers_get() {
		$this->load->library('zyk/OfferLib');
		$offers = $this->offerlib->getOffer();
		$this->response ( $offers,200);
	}
	
	public function restoffers_get() {
		$this->load->library('zyk/OfferLib');
		$restid = $this->get('restid');
		$offers = $this->offerlib->getRestaurantOffer($restid);
		$newoffers = array();
		foreach ($offers as $newoffer) {
			$offer = array();
			$offer['id'] = $newoffer['id'];
			$offer['title'] = $newoffer['title'];
			$offer['description'] = $newoffer['description'];
			$offer['avatar'] = $newoffer['image'];
			$offer['coupon_code'] = '';
			$offer['status'] = $newoffer['status'];
			$offer['priority'] = 1;
			$offer['url'] = '';
			$offer['restid'] = $newoffer['restid'];
			$offer['offer_type'] = 0;
			$offer['position'] = 0;
			$offer['restname'] = '';
			$offer['areaid'] = 1;
			$offer['cityid'] = 1;
			$offer['zone_id'] = 1;
			$newoffers[] = $offer;
		}
		$this->response ( $newoffers,200);
	}
	
}