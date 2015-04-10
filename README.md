# SimilarWeb rank builder
Uses SimilarWeb API to get a list of the page rank of (listed)websites
Saves the downloaded files to the `data` folder. This way we don't have to download them twice and accounts for our quota.

## Usage
1. Add your list of sites to `urls.php`
2. Run `run.php`

### Test data
- Downloads JSON from a test URL. To add to the rank data. Saves it to (`[domainname].rank.json`)
- Test URL's
- Saves a data (`[domainname].json`) file with an empty array
