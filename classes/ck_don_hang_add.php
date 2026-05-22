<?php
namespace PHPMaker2020\projectCoKhi;

/**
 * Page class
 */
class ck_don_hang_add extends ck_don_hang
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{5DCEF576-624A-4686-A415-DE69CC04A397}";

	// Table name
	public $TableName = 'ck_don_hang';

	// Page object name
	public $PageObjName = "ck_don_hang_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (ck_don_hang)
		if (!isset($GLOBALS["ck_don_hang"]) || get_class($GLOBALS["ck_don_hang"]) == PROJECT_NAMESPACE . "ck_don_hang") {
			$GLOBALS["ck_don_hang"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ck_don_hang"];
		}

		// Table object (nhan_vien)
		if (!isset($GLOBALS['nhan_vien']))
			$GLOBALS['nhan_vien'] = new nhan_vien();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ck_don_hang');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (nhan_vien)
		$UserTable = $UserTable ?: new nhan_vien();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $ck_don_hang;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ck_don_hang);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "ck_don_hangview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		$Security->loadUserID();
		$Security->UserID_Loaded();
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("ck_don_hanglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->so_don_hang_id->setVisibility();
		$this->ngay_sua_chua->setVisibility();
		$this->chung_loai->Visible = FALSE;
		$this->ten_thiet_bi->Visible = FALSE;
		$this->noi_dung_sua_chua->setVisibility();
		$this->thoi_gian_sua_chua->Visible = FALSE;
		$this->nguoi_nhap_lieu->setVisibility();
		$this->dich_vu->setVisibility();
		$this->baoduong_dinhky->setVisibility();
		$this->hoan_thanh->setVisibility();
		$this->ghi_chu->setVisibility();
		$this->updated_at->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->nguoi_nhap_lieu);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("ck_don_hanglist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Set up detail parameters
		$this->setupDetailParms();

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("ck_don_hanglist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = "ck_don_hanglist.php";
					if (GetPageName($returnUrl) == "ck_don_hanglist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "ck_don_hangview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->so_don_hang_id->CurrentValue = NULL;
		$this->so_don_hang_id->OldValue = $this->so_don_hang_id->CurrentValue;
		$this->ngay_sua_chua->CurrentValue = CurrentDate();
		$this->chung_loai->CurrentValue = NULL;
		$this->chung_loai->OldValue = $this->chung_loai->CurrentValue;
		$this->ten_thiet_bi->CurrentValue = NULL;
		$this->ten_thiet_bi->OldValue = $this->ten_thiet_bi->CurrentValue;
		$this->noi_dung_sua_chua->CurrentValue = NULL;
		$this->noi_dung_sua_chua->OldValue = $this->noi_dung_sua_chua->CurrentValue;
		$this->thoi_gian_sua_chua->CurrentValue = NULL;
		$this->thoi_gian_sua_chua->OldValue = $this->thoi_gian_sua_chua->CurrentValue;
		$this->nguoi_nhap_lieu->CurrentValue = CurrentUserID();
		$this->dich_vu->CurrentValue = NULL;
		$this->dich_vu->OldValue = $this->dich_vu->CurrentValue;
		$this->baoduong_dinhky->CurrentValue = 0;
		$this->hoan_thanh->CurrentValue = 0;
		$this->ghi_chu->CurrentValue = NULL;
		$this->ghi_chu->OldValue = $this->ghi_chu->CurrentValue;
		$this->updated_at->CurrentValue = NULL;
		$this->updated_at->OldValue = $this->updated_at->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'so_don_hang_id' first before field var 'x_so_don_hang_id'
		$val = $CurrentForm->hasValue("so_don_hang_id") ? $CurrentForm->getValue("so_don_hang_id") : $CurrentForm->getValue("x_so_don_hang_id");
		if (!$this->so_don_hang_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->so_don_hang_id->Visible = FALSE; // Disable update for API request
			else
				$this->so_don_hang_id->setFormValue($val);
		}

		// Check field name 'ngay_sua_chua' first before field var 'x_ngay_sua_chua'
		$val = $CurrentForm->hasValue("ngay_sua_chua") ? $CurrentForm->getValue("ngay_sua_chua") : $CurrentForm->getValue("x_ngay_sua_chua");
		if (!$this->ngay_sua_chua->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ngay_sua_chua->Visible = FALSE; // Disable update for API request
			else
				$this->ngay_sua_chua->setFormValue($val);
			$this->ngay_sua_chua->CurrentValue = UnFormatDateTime($this->ngay_sua_chua->CurrentValue, 14);
		}

		// Check field name 'noi_dung_sua_chua' first before field var 'x_noi_dung_sua_chua'
		$val = $CurrentForm->hasValue("noi_dung_sua_chua") ? $CurrentForm->getValue("noi_dung_sua_chua") : $CurrentForm->getValue("x_noi_dung_sua_chua");
		if (!$this->noi_dung_sua_chua->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->noi_dung_sua_chua->Visible = FALSE; // Disable update for API request
			else
				$this->noi_dung_sua_chua->setFormValue($val);
		}

		// Check field name 'nguoi_nhap_lieu' first before field var 'x_nguoi_nhap_lieu'
		$val = $CurrentForm->hasValue("nguoi_nhap_lieu") ? $CurrentForm->getValue("nguoi_nhap_lieu") : $CurrentForm->getValue("x_nguoi_nhap_lieu");
		if (!$this->nguoi_nhap_lieu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nguoi_nhap_lieu->Visible = FALSE; // Disable update for API request
			else
				$this->nguoi_nhap_lieu->setFormValue($val);
		}

		// Check field name 'dich_vu' first before field var 'x_dich_vu'
		$val = $CurrentForm->hasValue("dich_vu") ? $CurrentForm->getValue("dich_vu") : $CurrentForm->getValue("x_dich_vu");
		if (!$this->dich_vu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->dich_vu->Visible = FALSE; // Disable update for API request
			else
				$this->dich_vu->setFormValue($val);
		}

		// Check field name 'baoduong_dinhky' first before field var 'x_baoduong_dinhky'
		$val = $CurrentForm->hasValue("baoduong_dinhky") ? $CurrentForm->getValue("baoduong_dinhky") : $CurrentForm->getValue("x_baoduong_dinhky");
		if (!$this->baoduong_dinhky->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->baoduong_dinhky->Visible = FALSE; // Disable update for API request
			else
				$this->baoduong_dinhky->setFormValue($val);
		}

		// Check field name 'hoan_thanh' first before field var 'x_hoan_thanh'
		$val = $CurrentForm->hasValue("hoan_thanh") ? $CurrentForm->getValue("hoan_thanh") : $CurrentForm->getValue("x_hoan_thanh");
		if (!$this->hoan_thanh->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hoan_thanh->Visible = FALSE; // Disable update for API request
			else
				$this->hoan_thanh->setFormValue($val);
		}

		// Check field name 'ghi_chu' first before field var 'x_ghi_chu'
		$val = $CurrentForm->hasValue("ghi_chu") ? $CurrentForm->getValue("ghi_chu") : $CurrentForm->getValue("x_ghi_chu");
		if (!$this->ghi_chu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ghi_chu->Visible = FALSE; // Disable update for API request
			else
				$this->ghi_chu->setFormValue($val);
		}

		// Check field name 'updated_at' first before field var 'x_updated_at'
		$val = $CurrentForm->hasValue("updated_at") ? $CurrentForm->getValue("updated_at") : $CurrentForm->getValue("x_updated_at");
		if (!$this->updated_at->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->updated_at->Visible = FALSE; // Disable update for API request
			else
				$this->updated_at->setFormValue($val);
			$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 17);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->so_don_hang_id->CurrentValue = $this->so_don_hang_id->FormValue;
		$this->ngay_sua_chua->CurrentValue = $this->ngay_sua_chua->FormValue;
		$this->ngay_sua_chua->CurrentValue = UnFormatDateTime($this->ngay_sua_chua->CurrentValue, 14);
		$this->noi_dung_sua_chua->CurrentValue = $this->noi_dung_sua_chua->FormValue;
		$this->nguoi_nhap_lieu->CurrentValue = $this->nguoi_nhap_lieu->FormValue;
		$this->dich_vu->CurrentValue = $this->dich_vu->FormValue;
		$this->baoduong_dinhky->CurrentValue = $this->baoduong_dinhky->FormValue;
		$this->hoan_thanh->CurrentValue = $this->hoan_thanh->FormValue;
		$this->ghi_chu->CurrentValue = $this->ghi_chu->FormValue;
		$this->updated_at->CurrentValue = $this->updated_at->FormValue;
		$this->updated_at->CurrentValue = UnFormatDateTime($this->updated_at->CurrentValue, 17);
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->so_don_hang_id->setDbValue($row['so_don_hang_id']);
		$this->ngay_sua_chua->setDbValue($row['ngay_sua_chua']);
		$this->chung_loai->setDbValue($row['chung_loai']);
		$this->ten_thiet_bi->setDbValue($row['ten_thiet_bi']);
		$this->noi_dung_sua_chua->setDbValue($row['noi_dung_sua_chua']);
		$this->thoi_gian_sua_chua->setDbValue($row['thoi_gian_sua_chua']);
		$this->nguoi_nhap_lieu->setDbValue($row['nguoi_nhap_lieu']);
		$this->dich_vu->setDbValue($row['dich_vu']);
		$this->baoduong_dinhky->setDbValue($row['baoduong_dinhky']);
		$this->hoan_thanh->setDbValue($row['hoan_thanh']);
		$this->ghi_chu->setDbValue($row['ghi_chu']);
		$this->updated_at->setDbValue($row['updated_at']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['so_don_hang_id'] = $this->so_don_hang_id->CurrentValue;
		$row['ngay_sua_chua'] = $this->ngay_sua_chua->CurrentValue;
		$row['chung_loai'] = $this->chung_loai->CurrentValue;
		$row['ten_thiet_bi'] = $this->ten_thiet_bi->CurrentValue;
		$row['noi_dung_sua_chua'] = $this->noi_dung_sua_chua->CurrentValue;
		$row['thoi_gian_sua_chua'] = $this->thoi_gian_sua_chua->CurrentValue;
		$row['nguoi_nhap_lieu'] = $this->nguoi_nhap_lieu->CurrentValue;
		$row['dich_vu'] = $this->dich_vu->CurrentValue;
		$row['baoduong_dinhky'] = $this->baoduong_dinhky->CurrentValue;
		$row['hoan_thanh'] = $this->hoan_thanh->CurrentValue;
		$row['ghi_chu'] = $this->ghi_chu->CurrentValue;
		$row['updated_at'] = $this->updated_at->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// so_don_hang_id
		// ngay_sua_chua
		// chung_loai
		// ten_thiet_bi
		// noi_dung_sua_chua
		// thoi_gian_sua_chua
		// nguoi_nhap_lieu
		// dich_vu
		// baoduong_dinhky
		// hoan_thanh
		// ghi_chu
		// updated_at

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// so_don_hang_id
			$this->so_don_hang_id->ViewValue = $this->so_don_hang_id->CurrentValue;
			$this->so_don_hang_id->ViewCustomAttributes = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->ViewValue = $this->ngay_sua_chua->CurrentValue;
			$this->ngay_sua_chua->ViewValue = FormatDateTime($this->ngay_sua_chua->ViewValue, 14);
			$this->ngay_sua_chua->ViewCustomAttributes = "";

			// chung_loai
			$this->chung_loai->ViewValue = $this->chung_loai->CurrentValue;
			$this->chung_loai->ViewCustomAttributes = "";

			// ten_thiet_bi
			$this->ten_thiet_bi->ViewValue = $this->ten_thiet_bi->CurrentValue;
			$this->ten_thiet_bi->ViewCustomAttributes = "";

			// noi_dung_sua_chua
			$this->noi_dung_sua_chua->ViewValue = $this->noi_dung_sua_chua->CurrentValue;
			$this->noi_dung_sua_chua->ViewCustomAttributes = "";

			// thoi_gian_sua_chua
			$this->thoi_gian_sua_chua->ViewValue = $this->thoi_gian_sua_chua->CurrentValue;
			$this->thoi_gian_sua_chua->ViewValue = FormatNumber($this->thoi_gian_sua_chua->ViewValue, 2, -2, -2, -2);
			$this->thoi_gian_sua_chua->ViewCustomAttributes = "";

			// nguoi_nhap_lieu
			$curVal = strval($this->nguoi_nhap_lieu->CurrentValue);
			if ($curVal != "") {
				$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->lookupCacheOption($curVal);
				if ($this->nguoi_nhap_lieu->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->nguoi_nhap_lieu->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->CurrentValue;
					}
				}
			} else {
				$this->nguoi_nhap_lieu->ViewValue = NULL;
			}
			$this->nguoi_nhap_lieu->ViewCustomAttributes = "";

			// dich_vu
			if (ConvertToBool($this->dich_vu->CurrentValue)) {
				$this->dich_vu->ViewValue = $this->dich_vu->tagCaption(1) != "" ? $this->dich_vu->tagCaption(1) : "Yes";
			} else {
				$this->dich_vu->ViewValue = $this->dich_vu->tagCaption(2) != "" ? $this->dich_vu->tagCaption(2) : "No";
			}
			$this->dich_vu->ViewCustomAttributes = "";

			// baoduong_dinhky
			if (ConvertToBool($this->baoduong_dinhky->CurrentValue)) {
				$this->baoduong_dinhky->ViewValue = $this->baoduong_dinhky->tagCaption(1) != "" ? $this->baoduong_dinhky->tagCaption(1) : "Yes";
			} else {
				$this->baoduong_dinhky->ViewValue = $this->baoduong_dinhky->tagCaption(2) != "" ? $this->baoduong_dinhky->tagCaption(2) : "No";
			}
			$this->baoduong_dinhky->ViewCustomAttributes = "";

			// hoan_thanh
			if (ConvertToBool($this->hoan_thanh->CurrentValue)) {
				$this->hoan_thanh->ViewValue = $this->hoan_thanh->tagCaption(1) != "" ? $this->hoan_thanh->tagCaption(1) : "Yes";
			} else {
				$this->hoan_thanh->ViewValue = $this->hoan_thanh->tagCaption(2) != "" ? $this->hoan_thanh->tagCaption(2) : "No";
			}
			$this->hoan_thanh->ViewCustomAttributes = "";

			// ghi_chu
			$this->ghi_chu->ViewValue = $this->ghi_chu->CurrentValue;
			$this->ghi_chu->ViewCustomAttributes = "";

			// updated_at
			$this->updated_at->ViewValue = $this->updated_at->CurrentValue;
			$this->updated_at->ViewValue = FormatDateTime($this->updated_at->ViewValue, 17);
			$this->updated_at->ViewCustomAttributes = "";

			// so_don_hang_id
			$this->so_don_hang_id->LinkCustomAttributes = "";
			$this->so_don_hang_id->HrefValue = "";
			$this->so_don_hang_id->TooltipValue = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->LinkCustomAttributes = "";
			$this->ngay_sua_chua->HrefValue = "";
			$this->ngay_sua_chua->TooltipValue = "";

			// noi_dung_sua_chua
			$this->noi_dung_sua_chua->LinkCustomAttributes = "";
			$this->noi_dung_sua_chua->HrefValue = "";
			$this->noi_dung_sua_chua->TooltipValue = "";

			// nguoi_nhap_lieu
			$this->nguoi_nhap_lieu->LinkCustomAttributes = "";
			$this->nguoi_nhap_lieu->HrefValue = "";
			$this->nguoi_nhap_lieu->TooltipValue = "";

			// dich_vu
			$this->dich_vu->LinkCustomAttributes = "";
			$this->dich_vu->HrefValue = "";
			$this->dich_vu->TooltipValue = "";

			// baoduong_dinhky
			$this->baoduong_dinhky->LinkCustomAttributes = "";
			$this->baoduong_dinhky->HrefValue = "";
			$this->baoduong_dinhky->TooltipValue = "";

			// hoan_thanh
			$this->hoan_thanh->LinkCustomAttributes = "";
			$this->hoan_thanh->HrefValue = "";
			$this->hoan_thanh->TooltipValue = "";

			// ghi_chu
			$this->ghi_chu->LinkCustomAttributes = "";
			$this->ghi_chu->HrefValue = "";
			$this->ghi_chu->TooltipValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
			$this->updated_at->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// so_don_hang_id
			$this->so_don_hang_id->EditAttrs["class"] = "form-control";
			$this->so_don_hang_id->EditCustomAttributes = "";
			if (!$this->so_don_hang_id->Raw)
				$this->so_don_hang_id->CurrentValue = HtmlDecode($this->so_don_hang_id->CurrentValue);
			$this->so_don_hang_id->EditValue = HtmlEncode($this->so_don_hang_id->CurrentValue);
			$this->so_don_hang_id->PlaceHolder = RemoveHtml($this->so_don_hang_id->caption());

			// ngay_sua_chua
			$this->ngay_sua_chua->EditAttrs["class"] = "form-control";
			$this->ngay_sua_chua->EditCustomAttributes = "";
			$this->ngay_sua_chua->EditValue = HtmlEncode(FormatDateTime($this->ngay_sua_chua->CurrentValue, 14));
			$this->ngay_sua_chua->PlaceHolder = RemoveHtml($this->ngay_sua_chua->caption());

			// noi_dung_sua_chua
			$this->noi_dung_sua_chua->EditAttrs["class"] = "form-control";
			$this->noi_dung_sua_chua->EditCustomAttributes = "";
			if (!$this->noi_dung_sua_chua->Raw)
				$this->noi_dung_sua_chua->CurrentValue = HtmlDecode($this->noi_dung_sua_chua->CurrentValue);
			$this->noi_dung_sua_chua->EditValue = HtmlEncode($this->noi_dung_sua_chua->CurrentValue);
			$this->noi_dung_sua_chua->PlaceHolder = RemoveHtml($this->noi_dung_sua_chua->caption());

			// nguoi_nhap_lieu
			$this->nguoi_nhap_lieu->EditAttrs["class"] = "form-control";
			$this->nguoi_nhap_lieu->EditCustomAttributes = "";
			$curVal = trim(strval($this->nguoi_nhap_lieu->CurrentValue));
			if ($curVal != "")
				$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->lookupCacheOption($curVal);
			else
				$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->Lookup !== NULL && is_array($this->nguoi_nhap_lieu->Lookup->Options) ? $curVal : NULL;
			if ($this->nguoi_nhap_lieu->ViewValue !== NULL) { // Load from cache
				$this->nguoi_nhap_lieu->EditValue = array_values($this->nguoi_nhap_lieu->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $this->nguoi_nhap_lieu->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->nguoi_nhap_lieu->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->nguoi_nhap_lieu->EditValue = $arwrk;
			}

			// dich_vu
			$this->dich_vu->EditCustomAttributes = "";
			$this->dich_vu->EditValue = $this->dich_vu->options(FALSE);

			// baoduong_dinhky
			$this->baoduong_dinhky->EditCustomAttributes = "";
			$this->baoduong_dinhky->EditValue = $this->baoduong_dinhky->options(FALSE);

			// hoan_thanh
			$this->hoan_thanh->EditCustomAttributes = "";
			$this->hoan_thanh->EditValue = $this->hoan_thanh->options(FALSE);

			// ghi_chu
			$this->ghi_chu->EditAttrs["class"] = "form-control";
			$this->ghi_chu->EditCustomAttributes = "";
			$this->ghi_chu->EditValue = HtmlEncode($this->ghi_chu->CurrentValue);
			$this->ghi_chu->PlaceHolder = RemoveHtml($this->ghi_chu->caption());

			// updated_at
			$this->updated_at->EditAttrs["class"] = "form-control";
			$this->updated_at->EditCustomAttributes = "";
			$this->updated_at->EditValue = HtmlEncode(FormatDateTime($this->updated_at->CurrentValue, 17));
			$this->updated_at->PlaceHolder = RemoveHtml($this->updated_at->caption());

			// Add refer script
			// so_don_hang_id

			$this->so_don_hang_id->LinkCustomAttributes = "";
			$this->so_don_hang_id->HrefValue = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->LinkCustomAttributes = "";
			$this->ngay_sua_chua->HrefValue = "";

			// noi_dung_sua_chua
			$this->noi_dung_sua_chua->LinkCustomAttributes = "";
			$this->noi_dung_sua_chua->HrefValue = "";

			// nguoi_nhap_lieu
			$this->nguoi_nhap_lieu->LinkCustomAttributes = "";
			$this->nguoi_nhap_lieu->HrefValue = "";

			// dich_vu
			$this->dich_vu->LinkCustomAttributes = "";
			$this->dich_vu->HrefValue = "";

			// baoduong_dinhky
			$this->baoduong_dinhky->LinkCustomAttributes = "";
			$this->baoduong_dinhky->HrefValue = "";

			// hoan_thanh
			$this->hoan_thanh->LinkCustomAttributes = "";
			$this->hoan_thanh->HrefValue = "";

			// ghi_chu
			$this->ghi_chu->LinkCustomAttributes = "";
			$this->ghi_chu->HrefValue = "";

			// updated_at
			$this->updated_at->LinkCustomAttributes = "";
			$this->updated_at->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->so_don_hang_id->Required) {
			if (!$this->so_don_hang_id->IsDetailKey && $this->so_don_hang_id->FormValue != NULL && $this->so_don_hang_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->so_don_hang_id->caption(), $this->so_don_hang_id->RequiredErrorMessage));
			}
		}
		if ($this->ngay_sua_chua->Required) {
			if (!$this->ngay_sua_chua->IsDetailKey && $this->ngay_sua_chua->FormValue != NULL && $this->ngay_sua_chua->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngay_sua_chua->caption(), $this->ngay_sua_chua->RequiredErrorMessage));
			}
		}
		if (!CheckShortEuroDate($this->ngay_sua_chua->FormValue)) {
			AddMessage($FormError, $this->ngay_sua_chua->errorMessage());
		}
		if ($this->noi_dung_sua_chua->Required) {
			if (!$this->noi_dung_sua_chua->IsDetailKey && $this->noi_dung_sua_chua->FormValue != NULL && $this->noi_dung_sua_chua->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->noi_dung_sua_chua->caption(), $this->noi_dung_sua_chua->RequiredErrorMessage));
			}
		}
		if ($this->nguoi_nhap_lieu->Required) {
			if (!$this->nguoi_nhap_lieu->IsDetailKey && $this->nguoi_nhap_lieu->FormValue != NULL && $this->nguoi_nhap_lieu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nguoi_nhap_lieu->caption(), $this->nguoi_nhap_lieu->RequiredErrorMessage));
			}
		}
		if ($this->dich_vu->Required) {
			if ($this->dich_vu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->dich_vu->caption(), $this->dich_vu->RequiredErrorMessage));
			}
		}
		if ($this->baoduong_dinhky->Required) {
			if ($this->baoduong_dinhky->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->baoduong_dinhky->caption(), $this->baoduong_dinhky->RequiredErrorMessage));
			}
		}
		if ($this->hoan_thanh->Required) {
			if ($this->hoan_thanh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hoan_thanh->caption(), $this->hoan_thanh->RequiredErrorMessage));
			}
		}
		if ($this->ghi_chu->Required) {
			if (!$this->ghi_chu->IsDetailKey && $this->ghi_chu->FormValue != NULL && $this->ghi_chu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ghi_chu->caption(), $this->ghi_chu->RequiredErrorMessage));
			}
		}
		if ($this->updated_at->Required) {
			if (!$this->updated_at->IsDetailKey && $this->updated_at->FormValue != NULL && $this->updated_at->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->updated_at->caption(), $this->updated_at->RequiredErrorMessage));
			}
		}
		if (!CheckShortEuroDate($this->updated_at->FormValue)) {
			AddMessage($FormError, $this->updated_at->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("ck_danhmuc_suachua", $detailTblVar) && $GLOBALS["ck_danhmuc_suachua"]->DetailAdd) {
			if (!isset($GLOBALS["ck_danhmuc_suachua_grid"]))
				$GLOBALS["ck_danhmuc_suachua_grid"] = new ck_danhmuc_suachua_grid(); // Get detail page object
			$GLOBALS["ck_danhmuc_suachua_grid"]->validateGridForm();
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// so_don_hang_id
		$this->so_don_hang_id->setDbValueDef($rsnew, $this->so_don_hang_id->CurrentValue, "", FALSE);

		// ngay_sua_chua
		$this->ngay_sua_chua->setDbValueDef($rsnew, UnFormatDateTime($this->ngay_sua_chua->CurrentValue, 14), CurrentDate(), FALSE);

		// noi_dung_sua_chua
		$this->noi_dung_sua_chua->setDbValueDef($rsnew, $this->noi_dung_sua_chua->CurrentValue, "", FALSE);

		// nguoi_nhap_lieu
		$this->nguoi_nhap_lieu->setDbValueDef($rsnew, $this->nguoi_nhap_lieu->CurrentValue, NULL, FALSE);

		// dich_vu
		$tmpBool = $this->dich_vu->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->dich_vu->setDbValueDef($rsnew, $tmpBool, NULL, FALSE);

		// baoduong_dinhky
		$tmpBool = $this->baoduong_dinhky->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->baoduong_dinhky->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->baoduong_dinhky->CurrentValue) == "");

		// hoan_thanh
		$tmpBool = $this->hoan_thanh->CurrentValue;
		if ($tmpBool != "1" && $tmpBool != "0")
			$tmpBool = !empty($tmpBool) ? "1" : "0";
		$this->hoan_thanh->setDbValueDef($rsnew, $tmpBool, NULL, strval($this->hoan_thanh->CurrentValue) == "");

		// ghi_chu
		$this->ghi_chu->setDbValueDef($rsnew, $this->ghi_chu->CurrentValue, NULL, FALSE);

		// updated_at
		$this->updated_at->setDbValueDef($rsnew, UnFormatDateTime($this->updated_at->CurrentValue, 17), NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("ck_danhmuc_suachua", $detailTblVar) && $GLOBALS["ck_danhmuc_suachua"]->DetailAdd) {
				$GLOBALS["ck_danhmuc_suachua"]->id_don_hang->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["ck_danhmuc_suachua_grid"]))
					$GLOBALS["ck_danhmuc_suachua_grid"] = new ck_danhmuc_suachua_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "ck_danhmuc_suachua"); // Load user level of detail table
				$addRow = $GLOBALS["ck_danhmuc_suachua_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["ck_danhmuc_suachua"]->id_don_hang->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("ck_danhmuc_suachua", $detailTblVar)) {
				if (!isset($GLOBALS["ck_danhmuc_suachua_grid"]))
					$GLOBALS["ck_danhmuc_suachua_grid"] = new ck_danhmuc_suachua_grid();
				if ($GLOBALS["ck_danhmuc_suachua_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["ck_danhmuc_suachua_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["ck_danhmuc_suachua_grid"]->CurrentMode = "add";
					$GLOBALS["ck_danhmuc_suachua_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["ck_danhmuc_suachua_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["ck_danhmuc_suachua_grid"]->setStartRecordNumber(1);
					$GLOBALS["ck_danhmuc_suachua_grid"]->id_don_hang->IsDetailKey = TRUE;
					$GLOBALS["ck_danhmuc_suachua_grid"]->id_don_hang->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["ck_danhmuc_suachua_grid"]->id_don_hang->setSessionValue($GLOBALS["ck_danhmuc_suachua_grid"]->id_don_hang->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ck_don_hanglist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_nguoi_nhap_lieu":
					break;
				case "x_dich_vu":
					break;
				case "x_baoduong_dinhky":
					break;
				case "x_hoan_thanh":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_nguoi_nhap_lieu":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>