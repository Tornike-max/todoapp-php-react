import { Button, Select, SelectItem } from "@nextui-org/react";
import { variants } from "../constants/constants";

const MainHeader = () => {
  return (
    <div className="w-full flex justify-between items-center bg-slate-200 rounded-2xl">
      <Select
        variant="bordered"
        color="primary"
        label="Select Variant"
        className="max-w-xs"
      >
        {variants.map((variant) => (
          <SelectItem key={variant.value} value={variant.value}>
            {variant.label}
          </SelectItem>
        ))}
      </Select>

      <Button variant="bordered" color="primary" size="lg">
        Add A Task
      </Button>
    </div>
  );
};

export default MainHeader;
